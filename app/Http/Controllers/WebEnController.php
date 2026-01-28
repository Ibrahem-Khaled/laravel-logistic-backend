<?php

namespace App\Http\Controllers;

use App\Models\WebEn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebEnController extends Controller
{
    // عرض جميع البيانات
    public function index()
    {
        $webEns = WebEn::all();
        return view('dashboard.web.en', compact('webEns'));
    }

    // حفظ البيانات الجديدة
    public function store(Request $request)
    {
        // تحقق من الصحة
        $validated = $request->validate([
            'site_title' => 'nullable|string',
            'site_description' => 'nullable|string',
            'site_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keywords' => 'nullable|string',
            'hero_title' => 'nullable|string',
            'hero_description' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about_title' => 'nullable|string',
            'about_description' => 'nullable|string',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about_features' => 'nullable|json',
            'location_title' => 'nullable|string',
            'location_description' => 'nullable|string',
            'location_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $validated['about_features'] = json_decode($validated['about_features'], true);


        // معالجة الصور وحفظها
        $data = $request->all();

        if ($request->hasFile('site_image')) {
            $data['site_image'] = $request->file('site_image')->store('images', 'public');
        }
        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('images', 'public');
        }
        if ($request->hasFile('about_image')) {
            $data['about_image'] = $request->file('about_image')->store('images', 'public');
        }
        if ($request->hasFile('location_image')) {
            $data['location_image'] = $request->file('location_image')->store('images', 'public');
        }

        // إنشاء السجل
        WebEn::create($data);
        return redirect()->route('web-ens.index')->with('success', 'تم إنشاء البيانات بنجاح.');
    }

    // تحديث البيانات
    public function update(Request $request, WebEn $webEn)
    {
        // تحقق من الصحة
        $validated = $request->validate([
            'site_title' => 'nullable|string',
            'site_description' => 'nullable|string',
            'site_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keywords' => 'nullable|string',
            'hero_title' => 'nullable|string',
            'hero_description' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about_title' => 'nullable|string',
            'about_description' => 'nullable|string',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about_features' => 'nullable|json',
            'location_title' => 'nullable|string',
            'location_description' => 'nullable|string',
            'location_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $validated['about_features'] = json_decode($validated['about_features'], true);
        // معالجة الصور وحفظها
        $data = $request->all();

        if ($request->hasFile('site_image')) {
            Storage::disk('public')->delete($webEn->site_image); // حذف الصورة القديمة
            $data['site_image'] = $request->file('site_image')->store('images', 'public');
        }
        if ($request->hasFile('hero_image')) {
            Storage::disk('public')->delete($webEn->hero_image); // حذف الصورة القديمة
            $data['hero_image'] = $request->file('hero_image')->store('images', 'public');
        }
        if ($request->hasFile('about_image')) {
            Storage::disk('public')->delete($webEn->about_image); // حذف الصورة القديمة
            $data['about_image'] = $request->file('about_image')->store('images', 'public');
        }
        if ($request->hasFile('location_image')) {
            Storage::disk('public')->delete($webEn->location_image); // حذف الصورة القديمة
            $data['location_image'] = $request->file('location_image')->store('images', 'public');
        }

        // تحديث السجل
        $webEn->update($data);
        return redirect()->route('web-ens.index')->with('success', 'تم تحديث البيانات بنجاح.');
    }

    // حذف البيانات
    public function destroy(WebEn $webEn)
    {
        // حذف الصور المرتبطة
        Storage::disk('public')->delete([$webEn->site_image, $webEn->hero_image, $webEn->about_image, $webEn->location_image]);

        // حذف السجل
        $webEn->delete();
        return redirect()->route('web-ens.index')->with('success', 'تم حذف البيانات بنجاح.');
    }
}
