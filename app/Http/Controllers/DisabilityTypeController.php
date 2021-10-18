<?php

namespace App\Http\Controllers;

use App\Models\disability_type;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DisabilityTypeController extends Controller
{
    public function index(): View
    {
        $disability_types = disability_type::all();
        return view('settings.disability_type', compact('disability_types'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:disability_types']);
        disability_type::create($validate);
        toast('अपाङ्गताको किसिम थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(disability_type $disability_type): View
    {
        $disability_types = disability_type::all();
        return view('settings.disability_type', compact('disability_type','disability_types'));
    }
    
    public function update(Request $request,disability_type $disability_type): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('disability_types')
            ->ignore($disability_type)
        ]);
        toast('अपाङ्गताको किसिम सच्याउन सफल भयो ','success');
        $disability_type->update($validate);
        return redirect()->route('disability_type.index');
    }

    public function destroy(disability_type $disability_type): RedirectResponse
    {
        $disability_type->delete();
        toast('अपाङ्गताको किसिम हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
