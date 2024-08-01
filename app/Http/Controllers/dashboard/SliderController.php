<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Sliders;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Sliders::all();
        return view('dashboard.sliders', compact('sliders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'image' => 'nullable|image',
            'link' => 'nullable|url',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }

        Sliders::create($data);

        return redirect()->route('sliders.index')->with('success', 'Slider created successfully.');
    }

    public function update(Request $request, Sliders $slider)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'image' => 'nullable|image',
            'link' => 'nullable|url',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            if ($slider->image) {
                \Storage::disk('public')->delete($slider->image);
            }
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }

        $slider->update($data);

        return redirect()->route('sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Sliders $slider)
    {
        if ($slider->image) {
            \Storage::disk('public')->delete($slider->image);
        }
        $slider->delete();

        return redirect()->route('sliders.index')->with('success', 'Slider deleted successfully.');
    }
}
