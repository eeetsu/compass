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
            $getDate = $request->getData;
            $reserveDays = array_filter(array_combine($getDate, $getPart));
            foreach($reserveDays as $key => $value){
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
                $reserve_settings->decrement('limit_users');
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }



   public function delete(Request $request){
        // モーダルでキャンセルが選択された場合の処理

        DB::beginTransaction();
        try {
        // リクエストから予約設定IDを取得
        $reserve_setting_id = $request->reserve_setting_id;

        // 指定された予約を削除
        $reserve = ReserveSettings::findOrFail($reserve_setting_id);
        $reserve->delete();

        DB::commit(); // トランザクションをコミット

        } catch(\Exception $e) {
        DB::rollback(); // エラーが発生した場合はトランザクションをロールバック
        }

        // ユーザーIDを取得し、予約一覧ページにリダイレクト
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
        }
}
