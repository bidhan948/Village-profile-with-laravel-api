<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\roof;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoofController extends Controller
{
    public function index(): View
    {
        $roofs = roof::all();
        return view('settings.roof', compact('roofs'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:roofs']);
        roof::create($validate);
        toast('छानो थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(roof $roof): View
    {
        $roofs = roof::all();
        return view('settings.roof', compact('roof','roofs'));
    }
    
    public function update(Request $request,roof $roof): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('roofs')
            ->ignore($roof)
        ]);
        toast('छानो सच्याउन सफल भयो ','success');
        $roof->update($validate);
        return redirect()->route('roof.index');
    }

    public function destroy(roof $roof): RedirectResponse
    {
        $roof->delete();
        toast('छानो हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
