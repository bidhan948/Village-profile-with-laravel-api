<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\wall;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WallController extends Controller
{
    public function index(): View
    {
        $walls = wall::all();
        return view('settings.wall', compact('walls'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:walls']);
        wall::create($validate);
        toast('छानो थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(wall $wall): View
    {
        $walls = wall::all();
        return view('settings.wall', compact('wall','walls'));
    }
    
    public function update(Request $request,wall $wall): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('walls')
            ->ignore($wall)
        ]);
        toast('छानो सच्याउन सफल भयो ','success');
        $wall->update($validate);
        return redirect()->route('wall.index');
    }

    public function destroy(wall $wall): RedirectResponse
    {
        $wall->delete();
        toast('छानो हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
