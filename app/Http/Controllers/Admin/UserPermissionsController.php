<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserPermissionsController extends Controller
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

    public function index(User $user)
    {
        $permissions = $this->permissionModel->all();

        return view('admin.users.permissions.index', compact('user', 'permissions'));
    }

    public function update(User $user)
    {
        $user->grantPermissions(request('permissions', []));

        flash()->success('Success!', 'User Permissions successfully updated.');

        return redirect()->route('admin.userPermissions.index', $user->id);
    }
}
