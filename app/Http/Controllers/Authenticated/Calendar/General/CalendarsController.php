<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarsController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    public function reserve(Request $request){  //必要なのは予約のidと、ユーザーのid（中間テーブルreserve_setting_users）
        DB::beginTransaction();
        try{
            $getPart = $request->getPart;
            //dd($getPart);
            $getDate = $request->getData;
            $part = $request->part;

             // レングス取得
            $maxLength = max(count($getPart), count($getDate));
            $getPart = array_pad($getPart, $maxLength, null);

            //予約を複数まとめて取ることができる（削除には必要ない　１つずつなので）
            $reserveDays = array_filter(array_combine($getDate, $getPart));
            foreach($reserveDays as $key => $value){
                //いつの予約か、〇〇部か
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
                $reserve_settings->decrement('limit_users');  //上限の設定から減らす処理（削除は増やす処理する）
                //特定のユーザー
                $reserve_settings->users()->attach(Auth::id());// ユーザーの予約を追加
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }



   public function delete(Request $request){
    // モーダルでキャンセルが選択された場合の処理
    //dd($request);
    $user = Auth::user();
    $reserve_setting_id = $request->input('setting_reserve');
    $date = $request->input('setting_reserve');//inputの中はclass名
    $part = $request->input('setting_part');
    //dd($date,$part);


    DB::beginTransaction();
    try{
        $getPart = $request->getPart;
        $getDate = $request->getData;


        //いつの予約か、〇〇部か
        $reserve_settings = ReserveSettings::where('setting_reserve', $date)->where('setting_part', $part)->first(); //setting_reserveはdateから、setting_partはpartからデータを取得
        $reserve_settings->increment('limit_users'); // 上限の設定から増やす処理（削除は増やす処理する）→元に戻す処理
        $reserve_settings->users()->detach(Auth::id()); // ユーザーの予約を削除

        DB::commit();
        }catch(\Exception $e) {
        DB::rollback();
        }

    return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

}
