<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class CertificateExpiring extends Notification
{
    protected $certificate;

    use Queueable;

    public function __construct(\App\Certificate $certificate)
    {
        $this->certificate = $certificate;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', 'https://laravel.com')
                    ->line('Thank you for using our application!');
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

    public function toSlack($notifiable) {
        return (new SlackMessage)
            ->from('Ghost', ':ghost:')
            ->to('@eddfigueiredo')
            ->success()
            ->content('This is the slack message')
            ->attachment(function($attachment){
                $attachment->title('About to expire')
                    ->fields([
                        'Certificate' => $this->certificate->name,
                        'Expire' => $this->certificate->expiration
                    ]);
            });
    }

    public function testing() {
        print_r($this->certificate);
    }
}
