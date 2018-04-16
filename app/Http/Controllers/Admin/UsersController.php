<?php

namespace App\Http\Controllers\Admin;

use Sentinel;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        view()->share('rolesList', Role::all());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;

        return view('admin.users.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
        ], [
            'last_name.required' => 'Vui lòng nhập tên.',
            'last_name.max' => 'Tên quá dài, tối đa 255 kí tự.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
            'email.max' => 'Email quá dài, tối đa 255 kí tự.',
            'email.unique' => 'Email đã tồn tại.',
        ]);

        $user = Sentinel::register(
            request()->all(), !! request('active')
        )->syncRoles(request('roles', []));

        flash()->success('Success!', 'User successfully created.');

        return redirect()->route('quantri.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate(request(), [
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
        ], [
            'last_name.required' => 'Vui lòng nhập tên.',
            'last_name.max' => 'Tên quá dài, tối đa 255 kí tự.',
            'email.c' => 'Vui lòng nhập email.',
            'email.unique' => 'Email đã tồn tại.',
            'email.max' => 'Email quá dài, tối đa 255 kí tự.',
        ]);

        $user->update(request()->all())
            ->setActivation(!! request('active'))
            ->syncRoles(request('roles', []));

        flash()->success('Success!', 'User successfully updated.');

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        flash()->success('Success!', 'User successfully deleted.');
    }

    public function getDatatables()
    {
        return User::getDatatables();
    }
}
