<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PermissionsController extends Controller
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

    public function index()
    {
        $permissions = $this->permissionModel->all();

        return view('admin.permissions.index', compact('permissions'));
    }
}
