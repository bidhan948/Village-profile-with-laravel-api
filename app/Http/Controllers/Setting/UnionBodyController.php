<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\union_body;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnionBodyController extends Controller
{
    public function index(): View
    {
        $union_bodies = union_body::all();
        return view('settings.union_body', compact('union_bodies'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:union_bodies']);
        union_body::create($validate);
        toast('संघ संस्था थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(union_body $union_body): View
    {
        $union_bodies = union_body::all();
        return view('settings.union_body', compact('union_body','union_bodies'));
    }
    
    public function update(Request $request,union_body $union_body): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('union_bodies')
            ->ignore($union_body)
        ]);
        toast('संघ संस्था सच्याउन सफल भयो ','success');
        $union_body->update($validate);
        return redirect()->route('union-body.index');
    }

    public function destroy(union_body $union_body): RedirectResponse
    {
        $union_body->delete();
        toast('संघ संस्था हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
