<?php

namespace App\Http\Controllers\System_setting;

use App\helpers\SystemHelper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ManagePermissionController extends Controller
{
    private $permissions;

    public function __construct()
    {
        $this->permissions = Permission::all();
    }

    public function index(): View
    {
        return view('system_setting.permission', ['permissions' => $this->permissions]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate(['name' => 'required|unique:permissions']);
        permission::create($validate);
        toast('अनुमति प्रबन्ध थप्न सफल भयो ', 'success');
        return redirect()->back();
    }

    public function edit(permission $permission): View
    {
        return view(
            'system_setting.permission',
            [
                'permissions' => $this->permissions,
                'permission' => $permission
            ]
        );
    }

    public function update(Request $request, permission $permission): RedirectResponse
    {
        $validate = $request->validate([
            'name' => 'required',
            Rule::unique('permissions')
                ->ignore($permission)
        ]);
        toast('अनुमति प्रबन्ध सच्याउन सफल भयो ', 'success');
        $permission->update($validate);
        return redirect()->route('permission.index');
    }

    public function destroy(permission $permission): RedirectResponse
    {
        info(auth()->user()->id);
        return redirect()->back();
        $permission->delete();
        toast('अनुमति प्रबन्ध हटाउन सफल भयो ', 'success');
        return redirect()->back();
    }

    /************************this is for assigning a permission to role*******************************/
    public function assignPermission(Role $role): View
    {
        $data = (new SystemHelper())->getPermission();
        return view('system_setting.assign_permission', [
            'permissions' => $data['permission'],
            'model' => $data['model'],
            'all_permissions' => $data['allpermissions'],
            'role' => $role,
        ]);
    }

    public function assignPermissionStore(Request $request): RedirectResponse
    {
        if ($request->permission == "") {
            toast('अनुमति प्रबन्ध फिल्ड छ', 'error');
            return redirect()->back();
        }
        foreach ($request->permission as $key => $permission) {
            $roleId = $key;
            foreach ($permission as $permissionId) {
                $singlePermission = Permission::findById($permissionId);
                $permissionArr[] = $singlePermission->name;
            }
        }
        $role = Role::findById($roleId);
        $role->syncPermissions($permissionArr);
        toast('अनुमति प्रबन्ध हाल्न सफल भयो ', 'success');
        return redirect()->route('role.index');
    }
}
