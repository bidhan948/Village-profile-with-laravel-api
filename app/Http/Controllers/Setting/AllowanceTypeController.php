<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\allowance_type;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AllowanceTypeController extends Controller
{
    public function index(): View
    {
        $allowance_types = allowance_type::all();
        return view('settings.allowance_type', compact('allowance_types'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:allowance_types']);
        allowance_type::create($validate);
        toast('भत्ताको प्रकार थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(allowance_type $allowance_type): View
    {
        $allowance_types = allowance_type::all();
        return view('settings.allowance_type', compact('allowance_type','allowance_types'));
    }
    
    public function update(Request $request,allowance_type $allowance_type): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('allowance_types')
            ->ignore($allowance_type)
        ]);
        toast('भत्ताको प्रकार सच्याउन सफल भयो ','success');
        $allowance_type->update($validate);
        return redirect()->route('allowance-type.index');
    }

    public function destroy(allowance_type $allowance_type): RedirectResponse
    {
        $allowance_type->delete();
        toast('भत्ताको प्रकार हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
