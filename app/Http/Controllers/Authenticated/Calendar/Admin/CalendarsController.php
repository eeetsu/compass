<?php

namespace App\Http\Controllers\Authenticated\Calendar\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Calendars\Admin\CalendarView;
use App\Calendars\Admin\CalendarSettingView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;


class CalendarsController extends Controller
{
    public function show(){
        // 月初と月末の日付を取得
        $first_day_of_month = date('Y-m-01'); // 当月の1日を取得
        $last_day_of_month = date('Y-m-t'); // 当月の末日を取得

        // 現在の日時を取得して、CalendarViewオブジェクトを作成する
        $calendar = new CalendarView(time());

        // 各部の予約者数を取得する
        $one_part_count = ReserveSettings::whereBetween('setting_reserve', [$first_day_of_month, $last_day_of_month])->where('setting_part', '1')->with('users')->count();
        $two_part_count = ReserveSettings::whereBetween('setting_reserve', [$first_day_of_month, $last_day_of_month])->where('setting_part', '2')->with('users')->count();
        $three_part_count = ReserveSettings::whereBetween('setting_reserve', [$first_day_of_month, $last_day_of_month])->where('setting_part', '3')->with('users')->count();

        // calendar.blade.phpビューにデータを渡して表示する
        return view('authenticated.calendar.admin.calendar', compact('calendar', 'one_part_count', 'two_part_count', 'three_part_count'));
    }



    public function reserveDetail($date, $part){
        $reservePersons = User::with('reserveSettings')->whereHas('reserveSettings', function ($query) use ($date, $part) {
        $query->where('setting_reserve', $date)->where('setting_part', $part);
        })->get();
        return view('authenticated.calendar.admin.reserve_detail', compact('reservePersons', 'date', 'part'));
    }

    public function reserveSettings(){
        $calendar = new CalendarSettingView(time());
        return view('authenticated.calendar.admin.reserve_setting', compact('calendar'));
    }


    public function updateSettings(Request $request){
        $reserveDays = $request->input('reserve_day');
        foreach($reserveDays as $day => $parts){
            foreach($parts as $part => $frame){
                ReserveSettings::updateOrCreate([
                    'setting_reserve' => $day,
                    'setting_part' => $part,
                ],[
                    'setting_reserve' => $day,
                    'setting_part' => $part,
                    'limit_users' => $frame,
                ]);
            }
        }
        return redirect()->route('calendar.admin.setting', ['user_id' => Auth::id()]);
    }
}
