<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\toilet_type;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ToiletTypeController extends Controller
{
    public function index(): View
    {
        $toilet_types =toilet_type::all();
        return view('settings.toilet_type', compact('toilet_types'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:toilet_types']);
       toilet_type::create($validate);
        toast('चर्पी (शौचालय) थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(toilet_type $toilet_type): View
    {
        $toilet_types =toilet_type::all();
        return view('settings.toilet_type', compact('toilet_type','toilet_types'));
    }
    
    public function update(Request $request,toilet_type $toilet_type): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('toilet_types')
            ->ignore($toilet_type)
        ]);
        toast('चर्पी (शौचालय) सच्याउन सफल भयो ','success');
        $toilet_type->update($validate);
        return redirect()->route('toilet-type.index');
    }

    public function destroy(toilet_type $toilet_type): RedirectResponse
    {
        $toilet_type->delete();
        toast('चर्पी (शौचालय) हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
