<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\remitance;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RemitanceController extends Controller
{
    public function index(): View
    {
        $remitances = remitance::all();
        return view('settings.remitance', compact('remitances'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:remitances']);
        remitance::create($validate);
        toast('रेमिटेन्स थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(remitance $remitance): View
    {
        $remitances = remitance::all();
        return view('settings.remitance', compact('remitance','remitances'));
    }
    
    public function update(Request $request,remitance $remitance): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('remitances')
            ->ignore($remitance)
        ]);
        toast('रेमिटेन्स सच्याउन सफल भयो ','success');
        $remitance->update($validate);
        return redirect()->route('remitance.index');
    }

    public function destroy(remitance $remitance): RedirectResponse
    {
        $remitance->delete();
        toast('रेमिटेन्स हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
