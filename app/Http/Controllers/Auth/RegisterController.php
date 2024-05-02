<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Users\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\RegisterFormRequest;

use App\Models\Users\Subjects;

class RegisterController extends Controller
{
    /*お疲れ様です。

退出いたします。
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function registerView(Request $request){
       $subjects = Subjects::all();
    //    $errors = $request->session()->get('errors');
       return view('auth.register.register', compact('subjects'));
       }

    public function registerPost(RegisterFormRequest $request){
        // パラメータから値を取得
         if($request->isMethod('post')){
            $over_name=$request->input('over_name');
            $under_name=$request->input('under_name');
            $over_name_kana=$request->input('over_name_kana');
            $under_name_kana=$request->input('under_name_kana');
            $mail_address=$request->input('mail_address');
            $sex=$request->input('sex');
            $old_year=$request->input('old_year');
            $role=$request->input('role');
            $password=$request->input('password');
         }

         $validatedData = $request->validated();


        //  if($errors->any()){
            //  return back()->withErrors($errors)->withInput();
            // }

            DB::beginTransaction();
            try{
                $birth_day = $request->old_year . '-' . $request->old_month . '-' . $request->old_day;
                $user = User::create([
                    'over_name' => $request->over_name,
                    'under_name' => $request->under_name,
                    'over_name_kana' => $request->over_name_kana,
                    'under_name_kana' => $request->under_name_kana,
                    'mail_address' => $request->mail_address,
                    'sex' => $request->sex,
                    'birth_day' => $birth_day,
                    'role' => $request->role,
                    'password' => bcrypt($request->password),
                ]);

                // DB::beginTransaction();と同様な意味なのでコメントアウト
                // User::create([
                        // 'over_name' => $over_name,
                        // 'under_name' => $under_name,
                        // 'over_name_kana' => bcrypt($over_name_kana),
                        // 'under_name_kana' => bcrypt($under_name_kana),
                        // 'mail_address' => bcrypt($mail_address),
                        // 'sex' => intval($sex),
                        // 'old_year' => bcrypt($old_year),
                        // 'birth_day' => $validatedData['old_year'],
                        // 'role' => $role,
                        // 'password' => bcrypt($password),
                    // ]);

                $user = User::findOrFail($user->id);
        if ($request->filled('subject')) {
        $user->subjects()->attach($request->subject);
        }

        DB::commit();
        return view('auth.login.login');
        } catch(\Exception $e){
        DB::rollback();
        return redirect()->route('loginView');
        }
    }
}
