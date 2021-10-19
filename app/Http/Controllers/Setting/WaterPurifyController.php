<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\water_purify;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WaterPurifyController extends Controller
{
    public function index(): View
    {
        $water_purifies = water_purify::all();
        return view('settings.water_purify', compact('water_purifies'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:water_purifies']);
        water_purify::create($validate);
        toast('पानी पिउन योग्य (सुरक्षित) बनाउन थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(water_purify $water_purify): View
    {
        $water_purifies = water_purify::all();
        return view('settings.water_purify', compact('water_purify','water_purifies'));
    }
    
    public function update(Request $request,water_purify $water_purify): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('water_purifies')
            ->ignore($water_purify)
        ]);
        toast('पानी पिउन योग्य (सुरक्षित) बनाउन सच्याउन सफल भयो ','success');
        $water_purify->update($validate);
        return redirect()->route('water-purify.index');
    }

    public function destroy(water_purify $water_purify): RedirectResponse
    {
        $water_purify->delete();
        toast('पानी पिउन योग्य (सुरक्षित) बनाउन हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
