<?php

namespace App\Listeners;

use App\Events\ContainerLocationUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ExpoNotification;

class SendContainerLocationUpdateNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ContainerLocationUpdated $event): void
    {
        $container = $event->container;

        $shipments = $container->shipments;

        $users = $shipments->pluck('user')->unique();

        $expoPushTokens = [];
        foreach ($users as $user) {
            if ($user->expo_push_token) {
                $expoPushTokens[] = $user->expo_push_token;
            }
        }

        Notification::send($user, new ExpoNotification($expoPushTokens, 'تحديث موقع الحاوية', "تم تحديث موقع شحنتك. الرجاء التحقق من التفاصيل."));
    }
}
