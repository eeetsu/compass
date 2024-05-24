@extends('layouts.sidebar')

@section('content')
<div class="vh-100 pt-5" style="background:#ECF1F6">
  <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px background:#FFF">
    <div class="w-75 m-auto border" style="border-radius:5px">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
</div>
 <div class="modal js-modal" style="display:none">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
        <div class="w-100">
        <p>予約日: <span class="modal-date"></span></p>
        <p>時間: <span class="modal-part"></span></p>
        <div class="w-50 m-auto edit-modal-btn d-flex">
        <a class="js-modal-close btn btn-primary d-inline-block" href="#">閉じる</a>
        <input type="submit" class="btn btn-danger d-block" value="キャンセル">
        </div>
        </div>
        <input type="hidden" class="modal-date-input" value="" form="deleteParts">
        </div>
        </div>
        </td>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="calendar.js"></script>
@endsection
