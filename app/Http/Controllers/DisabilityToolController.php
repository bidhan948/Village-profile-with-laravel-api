<?php

namespace App\Http\Controllers;

use App\Models\disability_tool;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DisabilityToolController extends Controller
{
    public function index(): View
    {
        $disability_tools = disability_tool::all();
        return view('settings.disability_tool', compact('disability_tools'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:disability_tools']);
        disability_tool::create($validate);
        toast('अपाङ्गताको साहायक सामग्री थप्न सफल भयो ', 'success');
        return redirect()->back();
    }

    public function edit(disability_tool $disability_tool): View
    {
        $disability_tools = disability_tool::all();
        return view('settings.disability_tool', compact('disability_tool', 'disability_tools'));
    }

    public function update(Request $request, disability_tool $disability_tool): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('disability_tools')
                ->ignore($disability_tool)
        ]);
        toast('अपाङ्गताको साहायक सामग्री सच्याउन सफल भयो ', 'success');
        $disability_tool->update($validate);
        return redirect()->route('disability_tool.index');
    }

    public function destroy(disability_tool $disability_tool): RedirectResponse
    {
        $disability_tool->delete();
        toast('अपाङ्गताको साहायक सामग्री हटाउन सफल भयो ', 'success');
        return redirect()->back();
    }
}
