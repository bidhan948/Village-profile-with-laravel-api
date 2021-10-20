<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\disease;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DiseaseController extends Controller
{
    public function index(): View
    {
        $diseases = disease::all();
        return view('settings.disease', compact('diseases'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:diseases']);
        disease::create($validate);
        toast('दीर्घ रोग थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(disease $disease): View
    {
        $diseases = disease::all();
        return view('settings.disease', compact('disease','diseases'));
    }
    
    public function update(Request $request,disease $disease): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('diseases')
            ->ignore($disease)
        ]);
        toast('दीर्घ रोग सच्याउन सफल भयो ','success');
        $disease->update($validate);
        return redirect()->route('disease.index');
    }

    public function destroy(disease $disease): RedirectResponse
    {
        $disease->delete();
        toast('दीर्घ रोग हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
