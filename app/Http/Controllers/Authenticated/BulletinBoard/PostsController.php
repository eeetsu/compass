<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
// use App\Models\Posts\SubCategory;
use App\Models\Categories\SubCategory as CategorySubCategory;
use App\Models\Users\User;
use App\Http\Requests\BulletinBoard\PostFormRequest;
use Auth;

class PostsController extends Controller
{
    public function show(Request $request){
        $posts = Post::with('user', 'postComments','likes')->get();
        $categories = MainCategory::get();
        $like = new Like;
        $post_comment = new Post;

        $user = Auth::user();

        foreach($posts as $post){
        $post->like_count = $post->likes->count(); // いいね数をカウントしてpostに追加
        }

        if(!empty($request->keyword)){
            $posts = Post::with('user', 'postComments')
            ->where('post_title', 'like', '%'.$request->keyword.'%')
            ->orWhere('post', 'like', '%'.$request->keyword.'%')->get();
        }else if($request->category_word){
            $sub_category = $request->category_word;
            $posts = Post::with('user', 'postComments')->get();
        }else if($request->like_posts){
            $likes = Auth::user()->likePostId()->get('like_post_id');
            $posts = Post::with('user', 'postComments')
            ->whereIn('id', $likes)->get();
        }else if($request->my_posts){
            $posts = Post::with('user', 'postComments')
            ->where('user_id', Auth::id())->get();
        }
        return view('authenticated.bulletinboard.posts', compact('posts', 'categories', 'like', 'post_comment', 'user'));
    }

    public function postDetail($post_id){
        $post = Post::with('user', 'postComments', 'subCategories')->findOrFail($post_id);
        $sub_category = $post->subCategories->first(); // 最初のサブカテゴリーを取得
        return view('authenticated.bulletinboard.post_detail', compact('post', 'sub_category'));

    }

    public function postInput(){
        $main_categories = MainCategory::all();
        return view('authenticated.bulletinboard.post_create', compact('main_categories'));
    }

    public function postCreate(PostFormRequest $request){
        $post = Post::create([
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);

        $post->subCategories()->attach($request->sub_category_id);

        // サブカテゴリーとの関連付け
        return redirect()->route('post.show');
    }

    public function postEdit(Request $request){
        Post::where('id', $request->post_id)->update([
            'post_title' => $request->post_title,
            'post' => $request->post_body,

        ]);

        // SubCategory::where('id', $request->sub_category_id)->update([
            // 'sub_category' => $request->sub_category,
        // ]);

        // return redirect()->route('post.detail', ['id' => $request->post_id]);

        // $request = SubCategory::findOrFail($request->sub_category_id);
        // $request->sub_categories()->sync($request->sub_category);
         return redirect()->route('post.detail', ['id' => $request->sub_category_id]);

    }

    public function postDelete($id){
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }
    public function mainCategoryCreate(Request $request){
        $validatedData = $request->validate([
            'main_category_name' => 'required|string|max:255|unique:main_categories,main_category',
            ]);
        MainCategory::create(['main_category' => $request->main_category_name]);
        return redirect()->route('post.input');
    }

    public function subCategoryCreate(Request $request){
        $validatedData = $request->validate([
            'sub_category_name' => 'required|string|max:255|unique:sub_categories,sub_category',
            'main_category_id' => 'required|exists:sub_categories,id',
            ]);
        SubCategory::create(['sub_category' => $request->sub_category_name,
        'main_category_id' => $request->main_category_id]);
         return redirect()->route('post.input');
    }


    public function commentCreate(Request $request){
        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function myBulletinBoard(){
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }

    public function likeBulletinBoard(){
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }

    public function postLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->like_user_id = $user_id;
        $like->like_post_id = $post_id;
        $like->save();

        $post = Post::find($post_id);
        $post->like_count = $post->likes->count(); // いいね数を再度更新

        return response()->json();
    }

    public function postUnLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->where('like_user_id', $user_id)
             ->where('like_post_id', $post_id)
             ->delete();

             $post = Post::find($post_id);
             $post->like_count = $post->likes->count(); // いいね数を再度更新

             return response()->json();
    }

    public function userProfile($id){
        $user = User::with('subjects')->findOrFail($id);
        $subject_lists = Subjects::all();
        return view('authenticated.users.profile', compact('user', 'subject_lists'));
    }
}
