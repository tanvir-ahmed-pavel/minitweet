<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class newPost extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable){
        return [
            'id' => $this->user->id,
            'text' => 'Created a new post',
            'link' => '/post/'.$this->post,
        ];
    }
}
