<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\waste_management;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WasteManagementController extends Controller
{
    public function index(): View
    {
        $waste_managements = waste_management::all();
        return view('settings.waste_management', compact('waste_managements'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:waste_managements']);
        waste_management::create($validate);
        toast('फोहोर व्यवस्थापन थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(waste_management $waste_management): View
    {
        $waste_managements = waste_management::all();
        return view('settings.waste_management', compact('waste_management','waste_managements'));
    }
    
    public function update(Request $request,waste_management $waste_management): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('waste_managements')
            ->ignore($waste_management)
        ]);
        toast('फोहोर व्यवस्थापन सच्याउन सफल भयो ','success');
        $waste_management->update($validate);
        return redirect()->route('waste-management.index');
    }

    public function destroy(waste_management $waste_management): RedirectResponse
    {
        $waste_management->delete();
        toast('फोहोर व्यवस्थापन हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
