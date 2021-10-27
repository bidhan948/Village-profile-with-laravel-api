<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\address;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProvinceController extends Controller
{
    public function index(): View
    {
        $provinces = address::whereNull('address_id')->get();
        return view('settings.province', compact('provinces'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:addresses']);
        address::create($validate);
        toast('प्रदेश थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(address $province): View
    {
        $provinces = address::whereNull('address_id')->get();
        return view('settings.province', compact('province','provinces'));
    }
    
    public function update(Request $request,address $province): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('addresses')
            ->ignore($province)
        ]);
        toast('प्रदेश सच्याउन सफल भयो ','success');
        $province->update($validate);
        return redirect()->route('province.index');
    }

    public function destroy(address $province): RedirectResponse
    {
        $province->delete();
        toast('प्रदेश हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
