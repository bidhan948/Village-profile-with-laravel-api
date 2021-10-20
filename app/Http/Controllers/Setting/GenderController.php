<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\gender;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GenderController extends Controller
{
    public function index(): View
    {
        $genders = gender::all();
        return view('settings.gender', compact('genders'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:genders']);
        gender::create($validate);
        toast('लिङ्ग थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(gender $gender): View
    {
        $genders = gender::all();
        return view('settings.gender', compact('gender','genders'));
    }
    
    public function update(Request $request,gender $gender): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('genders')
            ->ignore($gender)
        ]);
        toast('लिङ्ग सच्याउन सफल भयो ','success');
        $gender->update($validate);
        return redirect()->route('gender.index');
    }

    public function destroy(gender $gender): RedirectResponse
    {
        $gender->delete();
        toast('लिङ्ग हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
