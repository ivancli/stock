<?php

namespace Stock\Notifications\Exceptions\Scrapers;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UnableToDownloadMarketResourceNotification extends Notification
{
    use Queueable;

    protected $resourceUrl;

    /**
     * Create a new notification instance.
     *
     * @param string $resourceUrl
     */
    public function __construct(string $resourceUrl)
    {
        $this->resourceUrl = $resourceUrl;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Stock Exception Notification - Unable to Download Market Resource')
            ->line('Unable to download market resource: ')
            ->action($this->resourceUrl, $this->resourceUrl);
    }

    /**
     * @param $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
            ->content('Stock Exception Notification - Unable to Download Market Resource ' . $this->resourceUrl);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
