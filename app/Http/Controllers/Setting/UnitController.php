<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\unit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnitController extends Controller
{
    public function index(): View
    {
        $units = unit::all();
        return view('settings.unit', compact('units'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:units']);
        unit::create($validate);
        toast('एकाइ थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(unit $unit): View
    {
        $units = unit::all();
        return view('settings.unit', compact('unit','units'));
    }
    
    public function update(Request $request,unit $unit): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('units')
            ->ignore($unit)
        ]);
        toast('एकाइ सच्याउन सफल भयो ','success');
        $unit->update($validate);
        return redirect()->route('health-service.index');
    }

    public function destroy(unit $unit): RedirectResponse
    {
        $unit->delete();
        toast('एकाइ हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
