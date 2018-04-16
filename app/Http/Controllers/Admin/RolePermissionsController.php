<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class RolePermissionsController extends Controller
{
    protected $permissionModel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Permission $permissionModel)
    {
        $this->permissionModel = $permissionModel;
    }

    public function index(Role $role)
    {
        $permissions = $this->permissionModel->all();

        return view('admin.roles.permissions.index', compact('role', 'permissions'));
    }

    public function update(Role $role)
    {
        $role->grantPermissions(request('permissions', []));

        flash()->success('Success!', 'Role Permissions successfully updated.');

        return redirect()->route('admin.rolePermissions.index', $role->id);
    }
}
