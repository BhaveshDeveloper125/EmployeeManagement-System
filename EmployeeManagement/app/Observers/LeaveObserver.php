<?php

namespace App\Observers;

use App\Models\Leave;
use App\Models\User;
use App\Notifications\LeaveNotification;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;


class LeaveObserver
{
    /**
     * Handle the Leave "created" event.
     */
    public function created(Leave $leave): void
    {
        $admins = User::whereHas('ExtraUserData', function ($query) {
            $query->where('isAdmin', true);
        })->get();

        try {
            Notification::send(
                $admins,
                new LeaveNotification(
                    $leave->name . ' from ' . $leave->department . ' department has requested a Leave',
                    $leave->id
                )
            );
        } catch (Exception $e) {
            Log::info("Notification Error: " . $e->getMessage());
        }
    }

    /**
     * Handle the Leave "updated" event.
     */
    public function updated(Leave $leave): void
    {
        //
    }

    /**
     * Handle the Leave "deleted" event.
     */
    public function deleted(Leave $leave): void
    {
        //
    }

    /**
     * Handle the Leave "restored" event.
     */
    public function restored(Leave $leave): void
    {
        //
    }

    /**
     * Handle the Leave "force deleted" event.
     */
    public function forceDeleted(Leave $leave): void
    {
        //
    }
}
