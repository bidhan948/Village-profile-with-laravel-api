<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\material;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MaterialController extends Controller
{
    public function index(): View
    {
        $materials = material::all();
        return view('settings.material', compact('materials'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:materials']);
        material::create($validate);
        toast('सामान थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(material $material): View
    {
        $materials = material::all();
        return view('settings.material', compact('material','materials'));
    }
    
    public function update(Request $request,material $material): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('materials')
            ->ignore($material)
        ]);
        toast('सामान सच्याउन सफल भयो ','success');
        $material->update($validate);
        return redirect()->route('material.index');
    }

    public function destroy(material $material): RedirectResponse
    {
        $material->delete();
        toast('सामान हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
