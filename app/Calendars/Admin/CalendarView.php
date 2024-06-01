<?php
namespace App\Calendars\Admin;
use Carbon\Carbon;
use App\Models\Users\User;

class CalendarView{
  private $carbon;

  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  public function getCarbonInstance(){
    return $this->carbon;
  }


  public function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table m-auto border">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th class="border">月</th>';
    $html[] = '<th class="border">火</th>';
    $html[] = '<th class="border">水</th>';
    $html[] = '<th class="border">木</th>';
    $html[] = '<th class="border">金</th>';
    $html[] = '<th class="border">土</th>';
    $html[] = '<th class="border">日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';

    $weeks = $this->getWeeks();

    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';
      $days = $week->getDays();

      foreach($days as $day){
        $startDay = $this->carbon->format("Y-m-01");
        $toDay = $this->carbon->format("Y-m-d");

         if($day instanceof CalendarWeek){
         $reserveCounts = ReserveSettings::where('setting_reserve', $day->getDetailDate())->sum('limit_users');
         $partCounts = $day->dayPartCounts($day->getDay());
         } else {
         $reserveCounts = '';
         $partCounts = '';
         }

         // day部分を修正
        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
          $html[] = '<td class="past-day border">';

        }else{
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<p class="day">';
            }else{
              $html[] = '<td class="border '.$day->getClassName().'">';
              }
        }
        $html[] = $day->render();

        //$counts = $day->dayPartCounts($day->getDay());
        //$one_part_count = $counts['one_part_count'];
        //$two_part_count = $counts['two_part_count'];
        //$three_part_count = $counts['three_part_count'];

        // 予約者数を表示
        $html[] = '<div class="adjust-area">';
        if($day->everyDay()){
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<a href="/calendar/' . $day->everyDay() . '/1" class="d-flex m-0 p-0">1部'  . $one_part_count . '</a>';
            $html[] = '<a href="/calendar/' . $day->everyDay() . '/2" class="d-flex m-0 p-0">2部'  . $two_part_count . '</a>';
            $html[] = '<a href="/calendar/' . $day->everyDay() . '/3" class="d-flex m-0 p-0">3部'  . $three_part_count . '</a>';
          }else{
            $html[] = '<a href="/calendar/' . $day->everyDay() . '/1" class="d-flex m-0 p-0">1部'  . $one_part_count . '</a>';
            $html[] = '<a href="/calendar/' . $day->everyDay() . '/2" class="d-flex m-0 p-0">2部'  . $two_part_count . '</a>';
            $html[] = '<a href="/calendar/' . $day->everyDay() . '/3" class="d-flex m-0 p-0">3部'  . $three_part_count . '</a>';
          }
        }

        // (' . $reserveCounts . '人)
        // href="/calendar/{date}/{part}" の部分について、{date}が特定の日付を取得できていない
        // href="/calendar/{date}/{part}" の部分について、{part}が特定の参加する部を取得できていない（１部、２部、３部）

        //<p>{{ count(Auth::user()->followers ?? []) }}名</p>

        $html[] = $partCounts;
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';

    return implode("", $html);
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
