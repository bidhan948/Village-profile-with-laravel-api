<?php

namespace App\Http\Controllers;

use App\Models\occupation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OccupationController extends Controller
{
    public function index(): View
    {
        $occupations = occupation::all();
        return view('settings.occupation', compact('occupations'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:occupations']);
        occupation::create($validate);
        toast('पेशा थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(occupation $occupation): View
    {
        $occupations = occupation::all();
        return view('settings.occupation', compact('occupation','occupations'));
    }
    
    public function update(Request $request,occupation $occupation): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('occupations')
            ->ignore($occupation)
        ]);
        toast('पेशा सच्याउन सफल भयो ','success');
        $occupation->update($validate);
        return redirect()->route('occupation.index');
    }

    public function destroy(occupation $occupation): RedirectResponse
    {
        $occupation->delete();
        toast('पेशा हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
