@extends('layouts.sidebar')
@section('content')
<div class="w-100 vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="calendar-i">
    <p class="calendar-text-p">{{ $calendar->getTitle() }}</p>
    {!! $calendar->render() !!}
    <div class="adjust-table-btn m-auto text-right">
      <div class="calendar-button">
        <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
      </div>
    </div>
  </div>
</div>
@endsection
