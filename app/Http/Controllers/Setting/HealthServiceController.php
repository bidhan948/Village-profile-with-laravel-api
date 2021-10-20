<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\health_service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HealthServiceController extends Controller
{
    public function index(): View
    {
        $health_services = health_service::all();
        return view('settings.health_service', compact('health_services'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:health_services']);
        health_service::create($validate);
        toast('स्वास्थ्य सेवा थप्न सफल भयो ','success');
        return redirect()->back();
    }
    
    public function edit(health_service $health_service): View
    {
        $health_services = health_service::all();
        return view('settings.health_service', compact('health_service','health_services'));
    }
    
    public function update(Request $request,health_service $health_service): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('health_services')
            ->ignore($health_service)
        ]);
        toast('स्वास्थ्य सेवा सच्याउन सफल भयो ','success');
        $health_service->update($validate);
        return redirect()->route('health-service.index');
    }

    public function destroy(health_service $health_service): RedirectResponse
    {
        $health_service->delete();
        toast('स्वास्थ्य सेवा हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
