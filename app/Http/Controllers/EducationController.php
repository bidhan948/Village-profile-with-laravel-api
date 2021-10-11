<?php

namespace App\Http\Controllers;

use App\Models\education;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EducationController extends Controller
{
    public function index(): View
    {
        $educations = education::all();
        return view('settings.education', compact('educations'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:educations']);
        education::create($validate);
        toast('शैक्षिकस्तर थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(education $education): View
    {
        $educations = education::all();
        return view('settings.education', compact('education','educations'));
    }
    
    public function update(Request $request,education $education): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('educations')
            ->ignore($education)
        ]);
        toast('शैक्षिकस्तर सच्याउन सफल भयो ','success');
        $education->update($validate);
        return redirect()->route('education.index');
    }

    public function destroy(education $education): RedirectResponse
    {
        $education->delete();
        toast('शैक्षिकस्तर हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
