<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\irrigation_type;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class IrrigationTypeController extends Controller
{
    public function index(): View
    {
        $irrigation_types = irrigation_type::all();
        return view('settings.irrigation_type', compact('irrigation_types'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:irrigation_types']);
        irrigation_type::create($validate);
        toast('सिंचाईको किसिम थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(irrigation_type $irrigation_type): View
    {
        $irrigation_types = irrigation_type::all();
        return view('settings.irrigation_type', compact('irrigation_type','irrigation_types'));
    }
    
    public function update(Request $request,irrigation_type $irrigation_type): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('irrigation_types')
            ->ignore($irrigation_type)
        ]);
        toast('सिंचाईको किसिम सच्याउन सफल भयो ','success');
        $irrigation_type->update($validate);
        return redirect()->route('irrigation-type.index');
    }

    public function destroy(irrigation_type $irrigation_type): RedirectResponse
    {
        $irrigation_type->delete();
        toast('सिंचाईको किसिम हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
