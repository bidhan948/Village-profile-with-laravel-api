<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\social_training;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SocialTrainingController extends Controller
{
    public function index(): View
    {
        $social_trainings = social_training::all();
        return view('settings.social_training', compact('social_trainings'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:social_trainings']);
        social_training::create($validate);
        toast('छानो थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(social_training $social_training): View
    {
        $social_trainings = social_training::all();
        return view('settings.social_training', compact('social_training','social_trainings'));
    }
    
    public function update(Request $request,social_training $social_training): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('social_trainings')
            ->ignore($social_training)
        ]);
        toast('छानो सच्याउन सफल भयो ','success');
        $social_training->update($validate);
        return redirect()->route('social-training.index');
    }

    public function destroy(social_training $social_training): RedirectResponse
    {
        $social_training->delete();
        toast('छानो हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
