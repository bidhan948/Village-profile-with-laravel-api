<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\relation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RelationController extends Controller
{
    public function index(): View
    {
        $relations = relation::all();
        return view('settings.relation', compact('relations'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:relations']);
        relation::create($validate);
        toast('नाता थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(relation $relation): View
    {
        $relations = relation::all();
        return view('settings.relation', compact('relation','relations'));
    }
    
    public function update(Request $request,relation $relation): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('relations')
            ->ignore($relation)
        ]);
        toast('नाता सच्याउन सफल भयो ','success');
        $relation->update($validate);
        return redirect()->route('relation.index');
    }

    public function destroy(relation $relation): RedirectResponse
    {
        $relation->delete();
        toast('नाता हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
