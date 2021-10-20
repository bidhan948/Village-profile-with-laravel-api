<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\fuel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FuelController extends Controller
{
    public function index(): View
    {
        $fuels = fuel::all();
        return view('settings.fuel', compact('fuels'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:fuels']);
        fuel::create($validate);
        toast('इन्धन थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(fuel $fuel): View
    {
        $fuels = fuel::all();
        return view('settings.fuel', compact('fuel','fuels'));
    }
    
    public function update(Request $request,fuel $fuel): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('fuels')
            ->ignore($fuel)
        ]);
        toast('इन्धन सच्याउन सफल भयो ','success');
        $fuel->update($validate);
        return redirect()->route('fuel.index');
    }

    public function destroy(fuel $fuel): RedirectResponse
    {
        $fuel->delete();
        toast('इन्धन हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
