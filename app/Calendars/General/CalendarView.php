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



  // ①
  if(in_array($day->everyDay(), $day->authReserveDay())){
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          if($reservePart == 1){
            $reservePart = "リモ1部";
            $part = "1";
          }else if($reservePart == 2){
            $reservePart = "リモ2部";
            $part = "2";
          }else if($reservePart == 3){
            $reservePart = "リモ3部";
            $part = "3";
          }

          if($day->everyDay()){
            if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
              //過去（予約した〇〇部参加の表示）
              $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px;color: black;" >'. $part .'部参加</p>';
              $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
            }else{
              //未来（予約するボタンの設置、参加する部　　予約したのをキャンセルするボタンの設定）
              //予約ボタンの設定
             $html[] = '<button type="submit" class="js-modal-open btn btn-danger p-0 w-75" name="delete_date" style="font-size:12px" part="'. $part .'" reservePart="'. $reservePart .'" value="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'">'. $reservePart .'</button>';
              $html[] = '<input type="hidden" name="getPart[]" value="" form="deleteParts">';
              $html[] = '<input type="hidden" name="getPart[]"  form="reserveParts">';
            }
          }
        }else{
          if($day->everyDay()){
            if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
              //過去
              $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px;color: black;" >受付終了</p>';
               $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
                }else{
                  //未来
                  // Calendar WeekDayファイルのfunction selectPartの中身
                  $html[] = $day->selectPart($day->everyDay());
            }
          }
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
