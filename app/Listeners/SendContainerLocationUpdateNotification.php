<?php

namespace App\Listeners;

use App\Events\ContainerLocationUpdated;
use App\Models\Notfication;
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

        foreach ($users as $user) {
            if ($user->expo_push_token) {

                Notfication::create([
                    'title' => 'تحديث موقع الحاوية',
                    'body' => 'تم تحديث موقع شحنتك. الرجاء التحقق من التفاصيل.',
                    'user_id' => $user->id,
                ]);
                // إرسال الإشعار لكل مستخدم على حدة باستخدام التوكين الخاص به
                Notification::send($user, new ExpoNotification([$user->expo_push_token], 'تحديث موقع الحاوية', "تم تحديث موقع شحنتك. الرجاء التحقق من التفاصيل."));
            }
        }
    }
}
