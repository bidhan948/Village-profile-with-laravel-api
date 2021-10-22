<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\yearly_expenditure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class YearlyExpenditureController extends Controller
{
    public function index(): View
    {
        $yearly_expenditures =yearly_expenditure::all();
        return view('settings.yearly_expenditure', compact('yearly_expenditures'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:yearly_expenditures']);
       yearly_expenditure::create($validate);
        toast('बार्षिक खर्च थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(yearly_expenditure $yearly_expenditure): View
    {
        $yearly_expenditures =yearly_expenditure::all();
        return view('settings.yearly_expenditure', compact('yearly_expenditure','yearly_expenditures'));
    }
    
    public function update(Request $request,yearly_expenditure $yearly_expenditure): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('yearly_expenditures')
            ->ignore($yearly_expenditure)
        ]);
        toast('बार्षिक खर्च सच्याउन सफल भयो ','success');
        $yearly_expenditure->update($validate);
        return redirect()->route('toilet-type.index');
    }

    public function destroy(yearly_expenditure $yearly_expenditure): RedirectResponse
    {
        $yearly_expenditure->delete();
        toast('बार्षिक खर्च हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
