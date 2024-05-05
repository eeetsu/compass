<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AtlasBulletinBoard</title>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Oswald:wght@200&display=swap" rel="stylesheet">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>

@if($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
       <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form action="{{ route('registerPost') }}" method="POST">
    <div class="w-100 vh-100 d-flex" style="align-items:center; justify-content:center;">
      <div class="w-25 vh-75 border p-3">
        <div class="register_form">
        <div class="d-flex mt-3" style="justify-content:space-between">
        <div class="" style="width:140px">
        @error('over_name')
          <span class="text-danger">{{ $errors->first('over_name') }}</span>
        @enderror
        <label class="d-block m-0" style="font-size:13px">姓</label>
        <div class="border-bottom border-primary" style="width:140px;">
        <input type="text" style="width:140px;" class="border-0 over_name" name="over_name"/>
      </div>
    </div>
    <div class="" style="width:140px">
      <label class=" d-block m-0" style="font-size:13px">名</label>
        <div class="border-bottom border-primary" style="width:140px;">
          <input type="text" style="width:140px;" class="border-0 under_name" name="under_name">
            @error('under_name')
             <span class="text-danger">{{ $errors->first('under_name') }}</span>
            @enderror
        </div>
      </div>
    </div>
    @error('over_name_kana')
      <span class="text-danger">{{ $errors->first('over_name_kana') }}</span>
    @enderror
    <div class="d-flex mt-3" style="justify-content:space-between">
      <div class="" style="width:140px">
        <label class="d-block m-0" style="font-size:13px">セイ</label>
         <div class="border-bottom border-primary" style="width:140px;">
        <input type="text" style="width:140px;" class="border-0 over_name_kana" name="over_name_kana">
      </div>
    </div>
    <div class="" style="width:140px">
    @error('under_name_kana')
      <span class="text-danger">{{ $errors->first('under_name_kana') }}</span>
    @enderror
    <label class="d-block m-0" style="font-size:13px">メイ</label>
    <div class="border-bottom border-primary" style="width:140px;">
      <input type="text" style="width:140px;" class="border-0 under_name_kana" name="under_name_kana">
      </div>
      </div>
    </div>
    <div class="mt-3">
      @error('mail_address')
        <span class="text-danger">{{ $errors->first('mail_address') }}</span>
      @enderror
      <label class="m-0 d-block" style="font-size:13px">メールアドレス</label>
        <div class="border-bottom border-primary">
         <input type="mail" class="w-100 border-0 mail_address" name="mail_address">
        </div>
      </div>
    </div>
    <div class="mt-3">
      @error('sex')
       <span class="text-danger">{{ $errors->first('sex') }}</span>
      @enderror
        <input type="radio" name="sex" class="sex" value="1">
        <label style="font-size:13px">男性</label>
        <input type="radio" name="sex" class="sex" value="2">
        <label style="font-size:13px">女性</label>
        <input type="radio" name="sex" class="sex" value="3">
        <label style="font-size:13px">その他</label>
    </div>
      <div class="mt-3">
            @error('birth_day')
              <span class="text-danger">{{ $errors->first('birth_day') }}</span>
            @enderror
            <label class="d-block m-0 aa" style="font-size:13px">生年月日</label>
              <select class="old_year" name="old_year">
                <option value="none">-----</option>
                  <option value="2000">2000</option>
                  <option value="2001">2001</option>
                  <option value="2002">2002</option>
                  <option value="2003">2003</option>
                  <option value="2004">2004</option>
                  <option value="2005">2005</option>
                  <option value="2006">2006</option>
                  <option value="2007">2007</option>
                  <option value="2008">2008</option>
                  <option value="2009">2009</option>
                  <option value="2010">2010</option>
              </select>
            <label style="font-size:13px">年</label>
              <select class="old_month" name="old_month">
                <option value="none">-----</option>
                  <option value="01">1</option>
                  <option value="02">2</option>
                  <option value="03">3</option>
                  <option value="04">4</option>
                  <option value="05">5</option>
                  <option value="06">6</option>
                  <option value="07">7</option>
                  <option value="08">8</option>
                  <option value="09">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
              </select>
            <label style="font-size:13px">月</label>
              <select class="old_day" name="old_day">
                <option value="none">-----</option>
                @for($i = 1; $i <= 31; $i++)
                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ $i }}</option>
                @endfor
              </select>
            <label style="font-size:13px">日</label>
         </div>
        <div class="mt-3">
            @error('role')
            <span class="text-danger">{{ $errors->first('role') }}</span>
            @enderror
            <label class="d-block m-0" style="font-size:13px">役職</label>
              <input type="radio" name="role" class="admin_role role" value="1">
              <label style="font-size:13px">教師(国語)</label>
              <input type="radio" name="role" class="admin_role role" value="2">
              <label style="font-size:13px">教師(数学)</label>
              <input type="radio" name="role" class="admin_role role" value="3">
              <label style="font-size:13px">教師(英語)</label>
              <input type="radio" name="role" class="other_role role" value="4">
              <label style="font-size:13px" class="other_role">生徒</label>
        </div>
      <div class="select_teacher d-none">
          @error('subject[]')
            <span class="text-danger">{{ $errors->first('subject[]') }}</span>
          @enderror
          <label class="d-block m-0" style="font-size:13px">選択科目</label>
          @if(isset($subjects))
            @foreach($subjects as $subject)
              <div class="">
                <input type="checkbox" name="subject[]" value="{{ $subject->id }}">
                <label>{{ $subject->subject }}</label>
              </div>
            @endforeach
          @endif
      </div>
    <div class="mt-3">
          @error('password')
          <span class="text-danger">{{ $errors->first('password') }}</span>
          @enderror
        <label class="d-block m-0" style="font-size:13px">パスワード</label>
        <div class="border-bottom border-primary">
          <input type="password" class="border-0 w-100 password" name="password">
        </div>
    </div>
    <div class="mt-3">
        @error('password')
         <span class="text-danger">{{ $errors->first('password') }}</span>
        @enderror
     <label class="d-block m-0" style="font-size:13px">確認用パスワード</label>
        <div class="border-bottom border-primary">
          <input type="password" class="border-0 w-100 password_confirmation" name="password_confirmation">
        </div>
    </div>
      <div class="mt-5 text-right">
        <input type="submit" class="btn btn-primary register_btn" value="新規登録" onclick="return confirm('登録してよろしいですか？')">
      </div>
    <div class="text-center">
      <a href="{{ route('login') }}">ログイン</a>
    </div>
    </div>
    {{ csrf_field() }}
    </div>
</form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ asset('js/register.js') }}" rel="stylesheet"></script>
</body>
</html>
