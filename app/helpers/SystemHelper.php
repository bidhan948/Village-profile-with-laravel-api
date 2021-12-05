<?php

namespace App\helpers;

use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class SystemHelper
{

    public function getPermission()
    {
        $permissions_raw = Permission::all();
        foreach ($permissions_raw as $key => $value) {
            $permission[] = Str::of($value->name)->before('_');
            $model[] = Str::of($value->name)->after('_');
        }
        $model = collect($model)->unique();
        $permission = collect($permission)->unique();

        return ['model' => $model, 'permission' => $permission,'allpermissions'=> $permissions_raw];
    }
}
