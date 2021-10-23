<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\religion;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReligionController extends Controller
{
    public function index(): View
    {
        $religions = religion::all();
        return view('settings.religion', compact('religions'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:religions']);
        religion::create($validate);
        toast('धर्म थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(religion $religion): View
    {
        $religions = religion::all();
        return view('settings.religion', compact('religion','religions'));
    }
    
    public function update(Request $request,religion $religion): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('religions')
            ->ignore($religion)
        ]);
        toast('धर्म सच्याउन सफल भयो ','success');
        $religion->update($validate);
        return redirect()->route('religion.index');
    }

    public function destroy(religion $religion): RedirectResponse
    {
        $religion->delete();
        toast('धर्म हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
