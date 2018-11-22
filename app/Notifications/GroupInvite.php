<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class GroupInvite extends Notification
{
    use Queueable;

    protected $invite_code;
    protected $group_owner;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($group_owner, $invite_code)
    {
        $this->group_owner = $group_owner;
        $this->invite_code = $invite_code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $invitation_link = route('join', $this->invite_code);

        return (new MailMessage)
                    ->line("You've been invited to join a gifting group by $this->group_owner.")
                    ->action('Join Group', $invitation_link);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
