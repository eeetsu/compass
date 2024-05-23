<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use App\Models\Users\User;
use Auth;

class CalendarView{

private $carbon;
function __construct($date){
$this->carbon = new Carbon($date);
}

public function getTitle(){
return $this->carbon->format('Y年n月');
}

function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';

    $weeks = $this->getWeeks();

foreach($weeks as $week){
  $html[] = '<tr class="'.$week->getClassName().'">';
  $days = $week->getDays();

foreach($days as $day){
  $startDay = $this->carbon->copy()->format("Y-m-01");
  $toDay = $this->carbon->copy()->format("Y-m-d");

  if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
    $html[] = '<td class="past-day border">';
  }else{
    $html[] = '<td class="border '.$day->getClassName().'">';

  }
  $html[] = $day->render();



  //（大枠）毎日の中で、ログインユーザーが予約する日付（予約選択まだしてない場合）
  if(in_array($day->everyDay(), $day->authReserveDay())){
    $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
    if($reservePart == 1){
      $reservePart = "リモ1部";
    }else if($reservePart == 2){
      $reservePart = "リモ2部";
    }else if($reservePart == 3){
      $reservePart = "リモ3部";
    }
    if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){   //月初〜毎日の中　かつ　今日〜毎日（未来or過去）である場合
      //（中身1の条件）予約選択した場合
      $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px"></p>';
      $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
    }else{
      //（中身1の条件）予約選択してない場合
      $html[] = '<button type="button" class="btn btn-danger p-0 w-75 edit-modal-open" data-date="'.$day->everyDay().'" data-part="'.$day->authReserveDate($day->everyDay())->first()->setting_part.'">'.$reservePart.'</button>';

        $html[] = '<div class="modal js-modal" style="display:none">';
        $html[] = '<div class="modal__bg js-modal-close"></div>';
        $html[] = '<div class="modal__content">';
        $html[] = '<div class="w-100">';
        $html[] = '<p>予約日: <span class="modal-date"></span></p>';
        $html[] = '<p>時間: <span class="modal-part"></span></p>';
        $html[] = '<div class="w-50 m-auto edit-modal-btn d-flex">';
        $html[] = '<a class="js-modal-close btn btn-primary d-inline-block" href="#">閉じる</a>';
        $html[] = '<input type="submit" class="btn btn-danger d-block" value="キャンセル">';
        $html[] = '</div>';
        $html[] = '</div>';
        $html[] = '<input type="hidden" class="modal-date-input" value="" form="deleteParts">';
        $html[] = '</div>';
        $html[] = '</div>';

        $html[] = '</td>';

        $html[] = '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
        $html[] = '<script src="calendar.js"></script>';
    }
      }else{
      //（中身2の条件）予約選択してない場合
      if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
        $html[] = '<p class="day">' . $this->carbon->format(""). ' 受付終了</p>';

      //（予約選択しているが未参加の場合、「未参加」と表示する）
        } else {
        if($day->selectPart($day->everyDay()) && $toDay >= $day->everyDay()){
        $html[] = '<p class="day">' . $this->carbon->format(""). ' 未参加</p>';

      //（予約選択していて参加した場合、選択した予約の「$reservePart」を表示する）
        } else {
        $html[] = '<p class="day">' . $day->selectPart($day->everyDay()) . '</p>';
        }
      }

  //（大枠）毎日の中で、ログインユーザーが予約する日付（予約選択した場合）
  //}else{
    //$html[] = $day->selectPart($day->everyDay());
  }

  $html[] = $day->getDate();
    $html[] = '</td>';
  }
    $html[] = '</tr>';
  }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';

  return implode('', $html);
}

protected function getWeeks(){
  $weeks = [];
  $firstDay = $this->carbon->copy()->firstOfMonth();
  $lastDay = $this->carbon->copy()->lastOfMonth();
  $week = new CalendarWeek($firstDay->copy());
  $weeks[] = $week;
  $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
  while($tmpDay->lte($lastDay)){
  $week = new CalendarWeek($tmpDay, count($weeks));
  $weeks[] = $week;
  $tmpDay->addDay(7);
  }
  return $weeks;
  }
}
