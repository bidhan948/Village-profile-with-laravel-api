<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\animal;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnimalController extends Controller
{
    public function index(): View
    {
        $animals = animal::all();
        return view('settings.animal', compact('animals'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:animals']);
        animal::create($validate);
        toast('जन्तु/जनावर वा पशुपंक्षि थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(animal $animal): View
    {
        $animals = animal::all();
        return view('settings.animal', compact('animal','animals'));
    }
    
    public function update(Request $request,animal $animal): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('animals')
            ->ignore($animal)
        ]);
        toast('जन्तु/जनावर वा पशुपंक्षि सच्याउन सफल भयो ','success');
        $animal->update($validate);
        return redirect()->route('animal.index');
    }

    public function destroy(animal $animal): RedirectResponse
    {
        $animal->delete();
        toast('जन्तु/जनावर वा पशुपंक्षि हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
