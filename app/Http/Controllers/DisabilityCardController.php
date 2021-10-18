<?php

namespace App\Http\Controllers;

use App\Models\disability_card;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DisabilityCardController extends Controller
{
    public function index(): View
    {
        $disability_cards = disability_card::all();
        return view('settings.disability_card', compact('disability_cards'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:disability_cards']);
        disability_card::create($validate);
        toast('अपाङ्गताको कार्डको किसिम थप्न सफल भयो ', 'success');
        return redirect()->back();
    }

    public function edit(disability_card $disability_card): View
    {
        $disability_cards = disability_card::all();
        return view('settings.disability_card', compact('disability_card', 'disability_cards'));
    }

    public function update(Request $request, disability_card $disability_card): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('disability_cards')
                ->ignore($disability_card)
        ]);
        toast('अपाङ्गताको कार्डको किसिम सच्याउन सफल भयो ', 'success');
        $disability_card->update($validate);
        return redirect()->route('disability_card.index');
    }

    public function destroy(disability_card $disability_card): RedirectResponse
    {
        $disability_card->delete();
        toast('अपाङ्गताको कार्डको किसिम हटाउन सफल भयो ', 'success');
        return redirect()->back();
    }
}
