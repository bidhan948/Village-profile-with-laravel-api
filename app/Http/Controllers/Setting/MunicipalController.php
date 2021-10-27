<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\address;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MunicipalController extends Controller
{
    public function index(): View
    {
        $municipals = address::whereNull('address_id')->with('subAddress')->get();
        return view('settings.municipal', compact('municipals'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:addresses', 'address_id' => 'required']);
        address::create($validate);
        toast('नगरपालिका थप्न सफल भयो ', 'success');
        return redirect()->back();
    }

    public function edit(address $municipal): View
    {
        $municipals = address::whereNull('address_id')->get();
        return view('settings.municipal', compact('municipal', 'municipals'));
    }

    public function update(Request $request, address $municipal): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            'address_id' => 'required'
        ]);
        toast('नगरपालिका सच्याउन सफल भयो ', 'success');
        $municipal->update($validate);
        return redirect()->route('municipal.index');
    }

    public function destroy(address $municipal): RedirectResponse
    {
        $municipal->delete();
        toast('नगरपालिका हटाउन सफल भयो ', 'success');
        return redirect()->back();
    }
}
