<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\foreign_country_settlement_reason;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ForeignCountrySettlementReasonController extends Controller
{
    public function index(): View
    {
        $foreign_country_settlement_reasons = foreign_country_settlement_reason::all();
        return view('settings.foreign_country_settlement_reason', compact('foreign_country_settlement_reasons'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:foreign_country_settlement_reasons']);
        foreign_country_settlement_reason::create($validate);
        toast('बाहिर बसोवास गर्नुको मुख्य कारण थप्न सफल भयो ', 'success');
        return redirect()->back();
    }

    public function edit(foreign_country_settlement_reason $foreign_settlement_reason): View
    {
        $foreign_country_settlement_reasons = foreign_country_settlement_reason::all();
        return view(
            'settings.foreign_country_settlement_reason',
            compact('foreign_country_settlement_reasons', 'foreign_settlement_reason')
        );
    }

    public function update(Request $request, foreign_country_settlement_reason $foreign_settlement_reason): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('foreign_country_settlement_reasons')
                ->ignore($foreign_settlement_reason)
        ]);
        toast('बाहिर बसोवास गर्नुको मुख्य कारण सच्याउन सफल भयो ', 'success');
        $foreign_settlement_reason->update($validate);
        return redirect()->route('foreign-settlement-reason.index');
    }

    public function destroy(foreign_country_settlement_reason $foreign_settlement_reason): RedirectResponse
    {
        $foreign_settlement_reason->delete();
        toast('बाहिर बसोवास गर्नुको मुख्य कारण हटाउन सफल भयो ', 'success');
        return redirect()->back();
    }
}
