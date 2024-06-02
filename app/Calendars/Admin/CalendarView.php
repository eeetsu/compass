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

    // 「$weeks」から週の情報を取得
    $weeks = $this->getWeeks();

    // 週ごとにループ
    foreach($weeks as $week){
      // 週のクラス名を取得してHTMLに追加
      $html[] = '<tr class="'.$week->getClassName().'">';
      // 週の日数情報を取得
      $days = $week->getDays();

      // 日ごとにループ
      foreach($days as $day){
        // 1日の開始日と現在日を取得
        $startDay = $this->carbon->format("Y-m-01");
        $toDay = $this->carbon->format("Y-m-d");

        // 日が週全体の場合と週の一部の場合で処理を分岐
         if($day instanceof CalendarWeek){
          // 予約数とパーツ数を取得
         $reserveCounts = ReserveSettings::where('setting_reserve', $day->getDetailDate())->sum('limit_users');
         $partCounts = $day->dayPartCounts($day->getDay());
         } else {
         $reserveCounts = '';
         $partCounts = '';
         }

         // 過去の日付かどうかでHTMLクラスを変える
        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
          $html[] = '<td class="past-day border">';

        }else{
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<p class="day">';
            }else{
              $html[] = '<td class="border '.$day->getClassName().'">';
              }
        }
        // 日付の表示をHTMLに追加
        $html[] = $day->render();

        // 日ごとの部数を取得
        //$counts = $day->dayPartCounts($day->getDay());
        //$one_part_count = $counts['one_part_count'];
        //$two_part_count = $counts['two_part_count'];
        //$three_part_count = $counts['three_part_count'];

        // 予約者数の表示部分をHTMLに追加（one_part_count、two_part_count、three_part_countの非表示バージョン）
        $html[] = '<div class="adjust-area">';
        if($day->everyDay()){
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<a href="/calendar/' . $day->everyDay() . '/1" class="d-flex m-0 p-0">1部 </a><p> . $one_part_count .</p>';
            $html[] = '<a href="/calendar/' . $day->everyDay() . '/2" class="d-flex m-0 p-0">2部 </a><p> . $two_part_count .</p>';
            $html[] = '<a href="/calendar/' . $day->everyDay() . '/3" class="d-flex m-0 p-0">3部 </a><p> . $three_part_count .</p>';
          }else{
            $html[] = '<a href="/calendar/' . $day->everyDay() . '/1" class="d-flex m-0 p-0">1部 </a><p> . $one_part_count .</p>';
            $html[] = '<a href="/calendar/' . $day->everyDay() . '/2" class="d-flex m-0 p-0">2部 </a><p> . $two_part_count .</p>';
            $html[] = '<a href="/calendar/' . $day->everyDay() . '/3" class="d-flex m-0 p-0">3部 </a><p> . $three_part_count .</p>';
          }
        }

        // 予約者数の表示部分をHTMLに追加
        //$html[] = '<div class="adjust-area">';
        //if($day->everyDay()){
        //  if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
        //    $html[] = '<a href="/calendar/' . $day->everyDay() . '/1" class="d-flex m-0 p-0">1部 </a><p>' . $one_part_count .'</p>';
        //    $html[] = '<a href="/calendar/' . $day->everyDay() . '/2" class="d-flex m-0 p-0">2部 </a><p>' . $two_part_count .'</p>';
        //    $html[] = '<a href="/calendar/' . $day->everyDay() . '/3" class="d-flex m-0 p-0">3部 </a><p>' . $three_part_count .'</p>';
        //  }else{
        //    $html[] = '<a href="/calendar/' . $day->everyDay() . '/1" class="d-flex m-0 p-0">1部 </a><p>' . $one_part_count .'</p>';
        //    $html[] = '<a href="/calendar/' . $day->everyDay() . '/2" class="d-flex m-0 p-0">2部 </a><p>' . $two_part_count .'</p>';
        //    $html[] = '<a href="/calendar/' . $day->everyDay() . '/3" class="d-flex m-0 p-0">3部 </a><p>' . $three_part_count .'</p>';
        //  }
        //}

        // (' . $reserveCounts . '人)
        // href="/calendar/{date}/{part}" の部分について、{date}が特定の日付を取得できていない
        // href="/calendar/{date}/{part}" の部分について、{part}が特定の参加する部を取得できていない（１部、２部、３部）

        //<p>{{ count(Auth::user()->followers ?? []) }}名</p>

        // 部数の表示をHTMLに追加
        $html[] = $partCounts;
        $html[] = '</td>';
      }
      // 行終了のタグをHTMLに追加
      $html[] = '</tr>';
    }
    // テーブルの終了タグをHTMLに追加
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';

    // HTMLを文字列に変換して返す
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
