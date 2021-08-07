<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordChangeNotification extends Notification
{
    use Queueable;

    public $title, $text, $route;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title, $text, $route)
    {
        $this->title = $title;
        $this->text = $text;
        $this->route = $route;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting($this->title)
                    ->line($this->text)
                    ->action('Notification Action', $this->route)
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->title,
            'text' => $this->text,
            'route' => $this->route,
        ];
    }
}
