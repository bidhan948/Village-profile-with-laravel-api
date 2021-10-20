<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\training;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TrainingController extends Controller
{
    public function index(): View
    {
        $trainings = training::all();
        return view('settings.training', compact('trainings'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:trainings']);
        training::create($validate);
        toast('तालिम थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(training $training): View
    {
        $trainings = training::all();
        return view('settings.training', compact('training','trainings'));
    }
    
    public function update(Request $request,training $training): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('trainings')
            ->ignore($training)
        ]);
        toast('तालिम सच्याउन सफल भयो ','success');
        $training->update($validate);
        return redirect()->route('training.index');
    }

    public function destroy(training $training): RedirectResponse
    {
        $training->delete();
        toast('तालिम हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
