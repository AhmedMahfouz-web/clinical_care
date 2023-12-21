<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MeetingScheduled extends Notification
{
    use Queueable;
    protected $meeting;

    public function __construct($meeting)
    {
        $this->meeting = $meeting;
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'A new meeting has been scheduled.',
            'user_name' => $this->meeting->user->first_name . $this->meeting->user->last_name,
            'doctor_name' => $this->meeting->doctor->first_name . $this->meeting->doctor->first_name,
            // 'meeting_link' => // generate or retrieve the meeting link,
        ];
    }
}
