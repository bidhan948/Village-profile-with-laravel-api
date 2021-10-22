<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\yearly_income;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class YearlyIncomeController extends Controller
{
    public function index(): View
    {
        $yearly_incomes = yearly_income::all();
        return view('settings.yearly_income', compact('yearly_incomes'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:yearly_incomes']);
        yearly_income::create($validate);
        toast('बार्षिक आम्दानी सेवा थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(yearly_income $yearly_income): View
    {
        $yearly_incomes = yearly_income::all();
        return view('settings.yearly_income', compact('yearly_income','yearly_incomes'));
    }
    
    public function update(Request $request,yearly_income $yearly_income): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('yearly_incomes')
            ->ignore($yearly_income)
        ]);
        toast('बार्षिक आम्दानी सेवा सच्याउन सफल भयो ','success');
        $yearly_income->update($validate);
        return redirect()->route('yearly-income.index');
    }

    public function destroy(yearly_income $yearly_income): RedirectResponse
    {
        $yearly_income->delete();
        toast('बार्षिक आम्दानी सेवा हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
