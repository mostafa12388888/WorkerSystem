<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WorkerNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $worker,$post;
    public function __construct($worker,$post)
    {
        $this->post=$post;
        $this->worker=$worker;
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

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
           "worker"=>$this->worker,
           "posts"=>$this->post,
        ];
    }
}
