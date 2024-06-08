@extends('layouts.sidebar')

@section('content')
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto">投稿一覧</p>
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>

      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>

      <!-- 投稿したカテゴリーボタンの表示・サブカテゴリー検索で表示-->
      @foreach($post->subCategories as $subcategory)
      <span class="category_btn_b" name="sub">{{ $subcategory->sub_category }}</span>
      @endforeach

      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status">
          <div class="mr-5">
            <i class="fa fa-comment"></i><span class="">{{ $post->postComments->count() }}</span>
          </div>
          <div>
            <p class="m-0">
            @if(Auth::user()->is_Like($post->id))
            <i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $post->like_count }}</span>
            @else
            <i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $post->like_count }}</span>
            @endif
            </p>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area border w-25">
    <div class="border m-4">
      <div class=""><a href="{{ route('post.input') }}" class="btn btn-info">　投稿　</a></div>
      <div class="">
        <input type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
        <input type="submit" value="　検索　" form="postSearchRequest" class="btn btn-info">
      </div>
      <input type="submit" name="like_posts" class="btn btn-pink_pink" value="　いいねした投稿　" form="postSearchRequest">
      <input type="submit" name="my_posts" class="btn btn-warning" value="　自分の投稿　" form="postSearchRequest">
      <label>カテゴリー検索</label>

      <div class="sub_btn">
          <ul>
            @foreach($categories as $category)

            <div class="">
              <li class="main_categories" category_id="{{ $category->id }}"><span class="accordion-title-search-two js-accordion-title-search-two">{{ $category->main_category }}<span></li>
              <div class="accordion-content-two">

                @foreach($category->subcategories as $subcategory)
            </div>
              <div class="">
                <li class="sub_categories" category_id="{{ $subcategory->id }}"><span class="accordion-title-search-two js-accordion-title-search-two">{{ $subcategory->sub_category }}<span></li>
                  <div class="accordion-content-two">
                  @endforeach

                  <!-- サブカテゴリーでの検索 -->
                  @foreach($category->subcategories as $subcategory)
                  <input type="submit" name="sub_categories" class="category_btn_b" value="{{ $subcategory->sub_category }}" form="postSearchRequest">
                  @endforeach
                  </div>
              </div>

            @endforeach
            </ul>
      </div>
    </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
@endsection
