<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\industry_type;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class IndustryTypeController extends Controller
{
    public function index(): View
    {
        $industry_types = industry_type::all();
        return view('settings.industry_type', compact('industry_types'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:industry_types']);
        industry_type::create($validate);
        toast('उधोगको प्रकार थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(industry_type $industry_type): View
    {
        $industry_types = industry_type::all();
        return view('settings.industry_type', compact('industry_type','industry_types'));
    }
    
    public function update(Request $request,industry_type $industry_type): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('industry_types')
            ->ignore($industry_type)
        ]);
        toast('उधोगको प्रकार सच्याउन सफल भयो ','success');
        $industry_type->update($validate);
        return redirect()->route('industry-type.index');
    }

    public function destroy(industry_type $industry_type): RedirectResponse
    {
        $industry_type->delete();
        toast('उधोगको प्रकार हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
