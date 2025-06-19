<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Mockery\Undefined;

class LeaveNotification extends Notification
{
    use Queueable;

    public $message;
    public $id;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $message, int $id)
    {
        $this->message=$message;
        $this->id=$id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toArray(object $notifiable): array
    {
        return [
            'message'=>$this->message, 
            'id'=>$this->id,       
        ];
    }
}
