<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\foreign_country;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ForeignCountryController extends Controller
{
    public function index(): View
    {
        $foreign_countries = foreign_country::all();
        return view('settings.foreign_country', compact('foreign_countries'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:foreign_countries']);
        foreign_country::create($validate);
        toast('बाहिर गएको/बसेको ठाउँ थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(foreign_country $foreign_country): View
    {
        $foreign_countries = foreign_country::all();
        return view('settings.foreign_country', compact('foreign_country','foreign_countries'));
    }
    
    public function update(Request $request,foreign_country $foreign_country): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('foreign_countries')
            ->ignore($foreign_country)
        ]);
        toast('बाहिर गएको/बसेको ठाउँ सच्याउन सफल भयो ','success');
        $foreign_country->update($validate);
        return redirect()->route('foreign_country.index');
    }

    public function destroy(foreign_country $foreign_country): RedirectResponse
    {
        $foreign_country->delete();
        toast('बाहिर गएको/बसेको ठाउँ हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
