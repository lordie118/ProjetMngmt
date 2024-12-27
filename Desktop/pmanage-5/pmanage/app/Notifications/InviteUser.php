<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InviteUser extends Notification {
    use Queueable;

    protected $invitation;

    public function __construct($invitation) {
        $this->invitation = $invitation;
    }

    public function via($notifiable) {
        return ['mail'];
    }

    public function toMail($notifiable) {
        return (new MailMessage)
            ->line('You have been invited to join a workspace.')
            ->action('Join', url('/accept-invitation/' . $this->invitation->token))
            ->line('Thank you for using our application!');
    }
}
