<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\entertainment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EntertainmentController extends Controller
{
    public function index(): View
    {
        $entertainments = entertainment::all();
        return view('settings.entertainment', compact('entertainments'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:entertainments']);
        entertainment::create($validate);
        toast('मनोरन्जन थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(entertainment $entertainment): View
    {
        $entertainments = entertainment::all();
        return view('settings.entertainment', compact('entertainment','entertainments'));
    }
    
    public function update(Request $request,entertainment $entertainment): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('entertainments')
            ->ignore($entertainment)
        ]);
        toast('मनोरन्जन सच्याउन सफल भयो ','success');
        $entertainment->update($validate);
        return redirect()->route('entertainment.index');
    }

    public function destroy(entertainment $entertainment): RedirectResponse
    {
        $entertainment->delete();
        toast('मनोरन्जन हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
