<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ExpoNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\Notfication as NotificationModel;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = NotificationModel::all();
        return view('dashboard.notifications', compact('notifications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $users = User::all();
        foreach ($users as $user) {
            if ($user->expo_push_token) {
                // إرسال الإشعار لكل مستخدم على حدة باستخدام التوكين الخاص به
                Notification::send($user, new ExpoNotification([$user->expo_push_token], $request->title, $request->body));
            }
        }

        NotificationModel::create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $request->image ?? null
        ]);

        return redirect()->back()->with('success', 'Notification created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|string'
        ]);

        $notification = NotificationModel::findOrFail($id);
        $users = User::all();
        foreach ($users as $user) {
            if ($user->expo_push_token) {
                // إرسال الإشعار لكل مستخدم على حدة باستخدام التوكين الخاص به
                Notification::send($user, new ExpoNotification([$user->expo_push_token], $request->title, $request->body));
            }
        }
        $notification->update($request->all());
        return redirect()->back()->with('success', 'Notification updated successfully.');
    }

    public function destroy($id)
    {
        NotificationModel::destroy($id);
        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }
}
