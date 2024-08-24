<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use YieldStudio\LaravelExpoNotifier\ExpoNotificationsChannel;
use YieldStudio\LaravelExpoNotifier\Dto\ExpoMessage;

class ExpoNotification extends Notification
{
    use Queueable;

    protected $usersToken;
    protected $title;
    protected $body;

    public function __construct($usersToken, $title, $body)
    {
        $this->usersToken = $usersToken;
        $this->title = $title;
        $this->body = $body;
    }

    public function via($notifiable): array
    {
        return [ExpoNotificationsChannel::class];
    }

    public function toExpoNotification($notifiable): ExpoMessage
    {
        return (new ExpoMessage())
            ->to($this->usersToken)
            ->title($this->title)
            ->body($this->body)
            ->channelId('default');
    }
}
