<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\forest_type;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ForestTypeController extends Controller
{
    public function index(): View
    {
        $forest_types = forest_type::all();
        return view('settings.forest_type', compact('forest_types'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:forest_types']);
        forest_type::create($validate);
        toast('बनको किसिम थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(forest_type $forest_type): View
    {
        $forest_types = forest_type::all();
        return view('settings.forest_type', compact('forest_type','forest_types'));
    }
    
    public function update(Request $request,forest_type $forest_type): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('forest_types')
            ->ignore($forest_type)
        ]);
        toast('बनको किसिम सच्याउन सफल भयो ','success');
        $forest_type->update($validate);
        return redirect()->route('forest-type.index');
    }

    public function destroy(forest_type $forest_type): RedirectResponse
    {
        $forest_type->delete();
        toast('बनको किसिम हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
