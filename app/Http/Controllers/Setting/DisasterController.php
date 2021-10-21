<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\disaster;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DisasterController extends Controller
{
    public function index(): View
    {
        $disasters = disaster::all();
        return view('settings.disaster', compact('disasters'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:disasters']);
        disaster::create($validate);
        toast('प्रकोप थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(disaster $disaster): View
    {
        $disasters = disaster::all();
        return view('settings.disaster', compact('disaster','disasters'));
    }
    
    public function update(Request $request,disaster $disaster): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('disasters')
            ->ignore($disaster)
        ]);
        toast('प्रकोप सच्याउन सफल भयो ','success');
        $disaster->update($validate);
        return redirect()->route('disaster.index');
    }

    public function destroy(disaster $disaster): RedirectResponse
    {
        $disaster->delete();
        toast('प्रकोप हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
