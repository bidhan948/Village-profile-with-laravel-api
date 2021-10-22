<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\ownership;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OwnershipController extends Controller
{
    public function index(): View
    {
        $ownerships = ownership::all();
        return view('settings.ownership', compact('ownerships'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:ownerships']);
        ownership::create($validate);
        toast('स्वामित्व थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(ownership $ownership): View
    {
        $ownerships = ownership::all();
        return view('settings.ownership', compact('ownership','ownerships'));
    }
    
    public function update(Request $request,ownership $ownership): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('ownerships')
            ->ignore($ownership)
        ]);
        toast('स्वामित्व सच्याउन सफल भयो ','success');
        $ownership->update($validate);
        return redirect()->route('health-service.index');
    }

    public function destroy(ownership $ownership): RedirectResponse
    {
        $ownership->delete();
        toast('स्वामित्व हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
