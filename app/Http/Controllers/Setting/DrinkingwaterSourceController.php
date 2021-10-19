<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\drinkingwater_source;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DrinkingwaterSourceController extends Controller
{
    public function index(): View
    {
        $drinkingwater_sources = drinkingwater_source::all();
        return view('settings.drinkingwater_source', compact('drinkingwater_sources'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:drinkingwater_sources']);
        drinkingwater_source::create($validate);
        toast('खानेपानीको स्रोत थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(drinkingwater_source $drinking_water_source): View
    {
        $drinkingwater_sources = drinkingwater_source::all();
        return view('settings.drinkingwater_source', compact('drinking_water_source','drinkingwater_sources'));
    }
    
    public function update(Request $request,drinkingwater_source $drinking_water_source): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('drinkingwater_sources')
            ->ignore($drinking_water_source)
        ]);
        toast('खानेपानीको स्रोत सच्याउन सफल भयो ','success');
        $drinking_water_source->update($validate);
        return redirect()->route('drinking-water-source.index');
    }

    public function destroy(drinkingwater_source $drinking_water_source): RedirectResponse
    {
        $drinking_water_source->delete();
        toast('खानेपानीको स्रोत हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
