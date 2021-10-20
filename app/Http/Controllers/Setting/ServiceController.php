<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = service::all();
        return view('settings.service', compact('services'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:services']);
        service::create($validate);
        toast('उपलब्ध सेवा थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(service $service): View
    {
        $services = service::all();
        return view('settings.service', compact('service','services'));
    }
    
    public function update(Request $request,service $service): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('services')
            ->ignore($service)
        ]);
        toast('उपलब्ध सेवा सच्याउन सफल भयो ','success');
        $service->update($validate);
        return redirect()->route('service.index');
    }

    public function destroy(service $service): RedirectResponse
    {
        $service->delete();
        toast('उपलब्ध सेवा हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
