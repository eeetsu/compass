<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AtlasBulletinBoard</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Oswald:wght@200&display=swap" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="all_content">
  <div class="d-flex">
    <div class="sidebar">
      @section('sidebar')



      {!! "<svg xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 0 24 24' width='24px' fill='#fff'>" !!}
{!! "<path d='M0 0h24v24H0z' fill='none'></path>" !!}
{!! "<path d='M17 10H7v2h10v-2zm2-7h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zm-5-5H7v2h7v-2z'></path>" !!}
{!! "</svg>" !!}
<p><a href="{{ route('top.show') }}">マイページ</a></p>


     <img src="https://lull-compass.com/image/icon/logout.svg" style="filter: invert(100%); background: transparent;">
      <p><a href="/logout">ログアウト</a></p>

      
      @can('admin')
      <p><a href="{{ route('calendar.general.show',['user_id' => Auth::id()]) }}">スクール予約</a></p>
      <p><a href="{{ route('calendar.admin.show',['user_id' => Auth::id()]) }}">スクール予約確認</a></p>
      <p><a href="{{ route('calendar.admin.setting',['user_id' => Auth::id()]) }}">スクール枠登録</a></p>
      <p><a href="{{ route('post.show') }}">掲示板</a></p>
      <p><a href="{{ route('user.show') }}">ユーザー検索</a></p>
      @endcan
      @can('edit')
      <p><a href="{{ route('calendar.general.show',['user_id' => Auth::id()]) }}">スクール予約</a></p>
      <p><a href="{{ route('calendar.admin.show',['user_id' => Auth::id()]) }}">スクール予約確認</a></p>
      <p><a href="{{ route('calendar.admin.setting',['user_id' => Auth::id()]) }}">スクール枠登録</a></p>
      <p><a href="{{ route('post.show') }}">掲示板</a></p>
      <p><a href="{{ route('user.show') }}">ユーザー検索</a></p>
      @endcan
      @can('read')
      <p><a href="{{ route('calendar.general.show',['user_id' => Auth::id()]) }}">スクール予約</a></p>
      <p><a href="{{ route('post.show') }}">掲示板</a></p>
      <p><a href="{{ route('user.show') }}">ユーザー検索</a></p>
      @endcan
      @show
    </div>
    <div class="main-container">
      @yield('content')
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/register.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/bulletin.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/user_search.js') }}" rel="stylesheet"></script>
  <script src="{{ asset('js/calendar.js') }}" rel="stylesheet"></script>
</body>
</html>
