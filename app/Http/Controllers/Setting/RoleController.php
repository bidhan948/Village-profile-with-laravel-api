<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private $roles;

    public function __construct()
    {
        $this->roles = Role::all();
    }

    public function index(): View
    {
        return view('settings.role', ['roles' => $this->roles]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:roles']);
        Role::create($validate);
        toast('भूमिका थप्न सफल भयो ', 'success');
        return redirect()->back();
    }

    public function edit(Role $role): View
    {
        abort_if($role->id == 1,403);
        return view(
            'settings.role',
            [
                'roles' => $this->roles,
                'role' => $role
            ]
        );
    }

    public function update(Request $request,Role $role): RedirectResponse
    {
        abort_if($role->id == 1,403);
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('roles')
            ->ignore($role)
        ]);
        toast('भूमिका सच्याउन सफल भयो ','success');
        $role->update($validate);
        return redirect()->route('role.index');
    }

    public function destroy(role $role): RedirectResponse
    {
        $role->delete();
        toast('भूमिका हटाउन सफल भयो ','success');
        return redirect()->back();
    }
}
