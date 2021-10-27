<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\EditCrop;
use App\Http\Requests\Settings\submitCrop;
use App\Models\Setting\crop;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class CropController extends Controller
{
    public function index(): View
    {
        $crops = crop::whereNull('crop_id')->get();
        return view('settings.crop.crop', compact('crops'));
    }

    public function store(submitCrop $request): RedirectResponse
    {
        crop::create($request->validated());
        toast('अन्न बाली थप्न सफल भयो', 'success');
        return redirect()->back();
    }
    public function edit(crop $crop): View
    {
        $crops = crop::whereNull('crop_id')->get();
        return view('settings.crop.crop', compact('crop','crops'));
    }
    
    public function update(EditCrop $request,crop $crop): RedirectResponse
    {
        $crop->update($request->validated());
        toast('अन्न बाली सच्याउन सफल भयो ','success');
        return redirect()->route('crop.index');
    }

    public function destroy(crop $crop): RedirectResponse
    {
        $crop->delete();
        toast('अन्न बाली हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
