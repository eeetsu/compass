@extends('layouts.sidebar')

@section('content')
  <div class="calendar-iii" style="border-radius:5px background:#FFF">
      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="calender-m">
        {!! $calendar->render() !!}
      </div>
      <div class="text-right w-75 m-auto">
        <div class="">
         <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts" style="text-align: center;">
        </div>
      </div>
  </div>

  <div class="modal js-modal" style="display:none">
    <div class="modal__bg js-modal-close"></div>
      <div class="modal__content">
        <div class="w-100">
          <p>予約日: <span class="modal-date"></span></p>
          <p>時間: <span class="modal-part"></span></p>
          <!-- 追加箇所 （routeの設定）-->


            <div class="w-50 m-auto edit-modal-btn d-flex">
              <a class="js-modal-close btn btn-primary d-inline-block" href="#">閉じる</a>
              <!-- キャンセルの実装 -->
                 <input type="submit" class="btn btn-danger d-block" href="/delete/calendar" value="キャンセル" form="deleteParts">
            </div>
        </div>
      </div>
      <input type="hidden" name="setting_reserve" class="setting_reserve" form="deleteParts">
      <input type="hidden" name="setting_part" class="setting_part" form="deleteParts">
  </div>
</td>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="calendar.js"></script>'
@endsection
