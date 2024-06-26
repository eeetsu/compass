@extends('layouts.sidebar')

@section('content')

<div class="search_content-ii">
  <div class="reserve_users_area">
    @if($users->count() > 0)
    @foreach($users as $user)
    <div class="border one_person">
      <div>
        <span>ID : </span><span>{{ $user->id }}</span>
      </div>
      <div><span>名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span>{{ $user->over_name }}</span>
          <span>{{ $user->under_name }}</span>
        </a>
      </div>
      <div>
        <span>カナ : </span>
        <span>({{ $user->over_name_kana }}</span>
        <span>{{ $user->under_name_kana }})</span>
      </div>
      <div>
        @if($user->sex == 1)
        <span>性別 : </span><span>男</span>
        @elseif($user->sex == 2)
        <span>性別 : </span><span>女</span>
        @else
        <span>性別 : </span><span>その他</span>
        @endif
      </div>
      <div>
        <span>生年月日 : </span><span>{{ $user->birth_day }}</span>
      </div>
      <div>
        @if($user->role == 1)
        <span>権限 : </span><span>教師(国語)</span>
        @elseif($user->role == 2)
        <span>権限 : </span><span>教師(数学)</span>
        @elseif($user->role == 3)
        <span>権限 : </span><span>講師(英語)</span>
        @else
        <span>権限 : </span><span>生徒</span>
        @endif
      </div>
      <div>
        @if($user->role == 4) <!-- 生徒のみの場合 -->
        <span>選択科目 : </span>
        @foreach($user->subjects as $subject)
        <span>{{ $subject->subject }}</span>
        @endforeach
        @endif
      </div>
    </div>
    @endforeach

    @else
    <p>検索結果はありません。</p>
    @endif

  </div>

  <div class="search_area w-25 border">
    <div class="">
      <div>
          <lavel>検索</lavel>
        </div>
      <div>
        <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      </div>
      <div>
        <div>
          <lavel>カテゴリ</lavel>
        </div>
        <select form="userSearchRequest" name="category">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div>
      <div>
        <div>
          <label>並び替え</label>
        </div>
        <select name="updown" form="userSearchRequest">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>
      <div class="">
        <p class="accordion-title-search js-accordion-title-search"><span>検索条件の追加</span></p>
        <div class="accordion-content">
          <div>
            <div class="area">
              <label>性別</label>
            </div>
            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
            <span>その他</span><input type="radio" name="sex" value="3" form="userSearchRequest">
          </div>
          <div>
            <div class="area">
              <label>権限</label>
            </div>
            <select name="role" form="userSearchRequest" class="engineer">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>
          <div class="selected_engineer">
            <label>選択科目</label>
              <form class="subject-select"  action="{{ route('user.show') }}" method="get" id="userSearchRequest">
                  @foreach($subject_lists as $subject_list)
                  <div class="subject-select-box">
                    <label>{{ $subject_list->subject }}</label>
                    <input type="checkbox" name="subjects[]" value="{{ $subject_list->id }}">
                  </div>
                  @endforeach
                  <input type="submit" value="編集" class="btn btn-primary">
                {{ csrf_field() }}
              </form>
          </div>
        </div>
      </div>
      <div class="search-reset-box">
            <input type="submit" class="btn btn-info" name="search_btn" value="　　　　　　検索　　　　　　" form="userSearchRequest">
            <input type="reset" class="btn-search_reset" value="　　　　　リセット　　　　　" onclick="this.form.reset()" form="userSearchRequest">
      </div>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
@endsection
