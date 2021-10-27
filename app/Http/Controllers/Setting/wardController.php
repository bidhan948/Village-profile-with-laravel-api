<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\address;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class wardController extends Controller
{
    public function index(): View
    {
        $wards = address::whereNull('address_id')->with('subAddress')->get();
        return view('settings.ward', compact('wards'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required', 'address_id' => 'required']);
        address::create($validate);
        toast('वार्ड नं थप्न सफल भयो ', 'success');
        return redirect()->back();
    }

    public function edit(address $ward): View
    {
        $wards = address::whereNull('address_id')->with('subAddress')->get();
        return view('settings.ward', compact('ward', 'wards'));
    }

    public function update(Request $request, address $ward): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            'address_id' => 'required'
        ]);
        toast('वार्ड नं सच्याउन सफल भयो ', 'success');
        $ward->update($validate);
        return redirect()->route('ward.index');
    }

    public function destroy(address $ward): RedirectResponse
    {
        $ward->delete();
        toast('वार्ड नं हटाउन सफल भयो ', 'success');
        return redirect()->back();
    }
}
