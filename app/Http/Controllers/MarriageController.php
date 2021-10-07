<?php

namespace App\Http\Controllers;

use App\Models\marriage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class MarriageController extends Controller
{
    public function index(): View
    {
        $marriages = marriage::all();
        return view('settings.marriage', compact('marriages'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:marriages']);
        marriage::create($validate);
        toast('वैवाहिक स्थिती थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(marriage $marriage): View
    {
        $marriages = marriage::all();
        return view('settings.marriage', compact('marriage','marriages'));
    }
    
    public function update(Request $request,marriage $marriage): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('marriages')
            ->ignore($marriage)
        ]);
        toast('वैवाहिक स्थिती सच्याउन सफल भयो ','success');
        $marriage->update($validate);
        return redirect()->route('marriage.index');
    }

    public function destroy(marriage $marriage): RedirectResponse
    {
        $marriage->delete();
        toast('वैवाहिक स्थिती हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
