<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\EditCropChild;
use App\Http\Requests\Settings\SubmitCropChild;
use App\Models\Setting\crop;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CropChildController extends Controller
{
    public function index(): View
    {
        $crops = crop::whereNull('crop_id')->with('children')->get();
        return view('settings.crop.crop_child', compact('crops'));
    }

    public function store(SubmitCropChild $request): RedirectResponse
    {
        crop::create($request->validated());
        toast('बाली अन्तर्गत थप्न सफल भयो', 'success');
        return redirect()->back();
    }
    public function edit(crop $crop_child): View
    {
        $crops = crop::whereNull('crop_id')->with('children')->get();
        return view('settings.crop.crop_child', compact('crop_child','crops'));
    }
    
    public function update(EditCropChild $request,crop $crop): RedirectResponse
    {
        $crop->update($request->validated());
        toast('बाली अन्तर्गत सच्याउन सफल भयो ','success');
        return redirect()->route('crop-child.index');
    }

    public function destroy(crop $crop): RedirectResponse
    {
        $crop->delete();
        toast('बाली अन्तर्गत हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
