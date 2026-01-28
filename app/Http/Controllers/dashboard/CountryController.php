<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('name_en')->paginate(20);
        return view('dashboard.countries.index', compact('countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255|unique:countries,name_en',
            'name_ar' => 'nullable|string|max:255',
            'iso2' => 'nullable|string|size:2|unique:countries,iso2',
            'is_active' => 'boolean',
        ]);

        Country::create($validated);
        return redirect()->route('dashboard.countries.index')
            ->with('success', 'تم إضافة الدولة بنجاح.');
    }

    public function update(Request $request, Country $country)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255|unique:countries,name_en,' . $country->id,
            'name_ar' => 'nullable|string|max:255',
            'iso2' => 'nullable|string|size:2|unique:countries,iso2,' . $country->id,
            'is_active' => 'boolean',
        ]);

        $country->update($validated);
        return redirect()->route('dashboard.countries.index')
            ->with('success', 'تم تحديث الدولة بنجاح.');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('dashboard.countries.index')
            ->with('success', 'تم حذف الدولة بنجاح.');
    }
}
