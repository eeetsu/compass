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
            //何部か
            $getPart = $request->getPart;
            //dd($getPart);
            //日付
            $getDate = $request->getData;
            //何部、日付
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
        DB::beginTransaction();
        try{
            $reserve_id = $request->reserve_id;
            $user_id = Auth::id();

            $reservation = Reservation::where('id', $reserve_id)->whereHas('users', function($query) use ($user_id){
            $query->where('user_id', $user_id);
            })->first();

            if($reservation){
                $reservation->users()->detach($user_id);
                $reservation->increment('limit_users');
                }else{
                    return redirect()->back()->with('error', 'Reservation not found');
                    }
                    DB::commit();
                    }catch(\Exception $e){
                    DB::rollback();
                    return redirect()->back()->with('error', 'An error occurred, please try again');
                    }
                    return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
                    }

            }
