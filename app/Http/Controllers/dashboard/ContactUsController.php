<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $contacts = ContactUs::paginate(10);
        return view('dashboard.contact-us', compact('contacts'));
    }

    public function store(Request $request)
    {
        $user = auth()->guard('api')->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        ContactUs::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'message' => $request->message,
        ]);
        return response()->json(['message' => 'تم الارسال بنجاح']);
    }

    public function delete($id)
    {
        $contact = ContactUs::find($id);
        $contact->delete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح');
    }
}
