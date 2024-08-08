<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notfication as Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        return view('dashboard.notifications', compact('notifications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|string'
        ]);

        $notification = Notification::create($request->all());
        return redirect()->back()->with('success', 'Notification created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|string'
        ]);

        $notification = Notification::findOrFail($id);
        $notification->update($request->all());
        return redirect()->back()->with('success', 'Notification updated successfully.');
    }

    public function destroy($id)
    {
        Notification::destroy($id);
        return redirect()->back()->with('success', 'Notification deleted successfully.');
    }
}
