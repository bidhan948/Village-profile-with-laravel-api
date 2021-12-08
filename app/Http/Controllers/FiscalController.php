<?php

namespace App\Http\Controllers;

use App\Models\System_setting\fiscal;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FiscalController extends Controller
{
    public $fiscals;

    public function __construct()
    {
        $this->fiscals = fiscal::query()
            ->orderBy('fiscal_year')
            ->get();
    }

    public function index(): View
    {
        return view('system_setting.fiscal', ['fiscals' => $this->fiscals]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['fiscal_year' => 'required|unique:fiscals', 'is_current' => 'present']);

        if ($request->is_current) {
            fiscal::where('is_current', fiscal::STATUS_ACTIVE)
                ->update(['is_current' => fiscal::STATUS_UNACTIVE]);
        }

        fiscal::create($validate);
        toast("आर्थिक बर्ष थप्न सफल भयो", "success");

        return redirect()->route('fiscal-year.index');
    }

    public function update(fiscal $fiscal_year, Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'fiscal_year' => [
                'required',
                Rule::unique('fiscals')
                    ->ignore($fiscal_year)
            ],
            'is_current' => 'present'
        ]);

        if ($request->is_current) {
            fiscal::where('is_current', fiscal::STATUS_ACTIVE)
                ->update(['is_current' => fiscal::STATUS_UNACTIVE]);
        }

        $fiscal_year->update($validate);
        toast("आर्थिक बर्ष सच्याउन सफल भयो", "success");
        return redirect()->back();
    }
}
