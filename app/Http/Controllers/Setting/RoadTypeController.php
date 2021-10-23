<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\road_type;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoadTypeController extends Controller
{
    public function index(): View
    {
        $road_types =road_type::all();
        return view('settings.road_type', compact('road_types'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:road_types']);
       road_type::create($validate);
        toast('सडकको प्रकार थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(road_type $road_type): View
    {
        $road_types =road_type::all();
        return view('settings.road_type', compact('road_type','road_types'));
    }
    
    public function update(Request $request,road_type $road_type): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('road_types')
            ->ignore($road_type)
        ]);
        toast('सडकको प्रकार सच्याउन सफल भयो ','success');
        $road_type->update($validate);
        return redirect()->route('toilet-type.index');
    }

    public function destroy(road_type $road_type): RedirectResponse
    {
        $road_type->delete();
        toast('सडकको प्रकार हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
