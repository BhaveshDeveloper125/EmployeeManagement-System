<?php

namespace App\Http\Controllers;

use App\Models\ExtraUserData;
use App\Models\Leave;
use App\Models\User;
use App\Notifications\LeaveNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class LeaveController extends Controller
{
    public function GetLeaves(Request $request)
    {

        
        try {
            
            $validation = $request->validate([
                'name'=>'required|string|max:255',
                'user_id'=>'required|numeric',
                'department'=>'required|string|max:255',
                'type'=>'required|string|in:medical_leave,casual_leave',
                'from'=>'required|date',
                'to'=>'required|date|after_or_equal:from',
                'duration'=>'required|in:half_day,full_day',
                'reason'=>'required',
            ]);

            $save = Leave::create($validation);

            if ($save) {
                $admins=User::whereHas('ExtraUserData',function($i){
                    $i->where('isAdmin',true);
                })->get();

                try {
                    Notification::send(
                    $admins,
                    new LeaveNotification( $validation['name'].' from'.$validation['department'].' department has requested a Leave')
                    );
                } catch (Exception $e) {
                    Log::info("Notification Error: $e");
                }

                return redirect()->back()->with(['leave_send'=>true]);
            }else{
                return redirect()->back()->with(['leave_not_send'=>true]);
            }

        } catch (Exception $e) {
            Log::info("Error While Requesting Leave : $e");
        }

    }
}
