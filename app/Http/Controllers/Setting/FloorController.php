<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\floor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FloorController extends Controller
{
    public function index(): View
    {
        $floors = floor::all();
        return view('settings.floor', compact('floors'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:floors']);
        floor::create($validate);
        toast('भुइ थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(floor $floor): View
    {
        $floors = floor::all();
        return view('settings.floor', compact('floor','floors'));
    }
    
    public function update(Request $request,floor $floor): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('floors')
            ->ignore($floor)
        ]);
        toast('भुइ सच्याउन सफल भयो ','success');
        $floor->update($validate);
        return redirect()->route('floor.index');
    }

    public function destroy(floor $floor): RedirectResponse
    {
        $floor->delete();
        toast('भुइ हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
