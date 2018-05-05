<?php

namespace App\Models;

use Sentinel;
use Activation;
use Datatables;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Exceptions\ModelShouldNotDeletedException;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends EloquentUser implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable,
        Authorizable,
        CanResetPassword,
        Notifiable;

    protected $fillable = [
        'last_name',
        'email',
        'password',
        'permissions',
    ];

    public static function boot()
    {
        parent::boot();
    }

    public function getAvatarAttribute()
    {
        if (! empty($this->attributes['avatar'])) {
            return $this->attributes['avatar'];
        }

        return asset('/img/default_avatar.png');
    }

    public function hasAccess($permissions)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return parent::hasAccess($permissions);
    }

    public function hasAnyAccess($permissions)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return parent::hasAnyAccess($permissions);
    }

    public static function getDatatables()
    {
        $model = static::select([
            'id', 'last_name', 'email', 'last_login'
        ])
            ->with('roles', 'activations');

        return datatables()->eloquent($model)
            ->filter(function ($query) {
                if (request()->has('name')) {
                    $query->where(function ($query) {
                        $query->where('last_name', 'like', '%'.request('name').'%');
                    });
                }

                if (request()->has('email')) {
                    $query->where('email', 'like', '%'.request('email').'%');
                }
            })
            ->editColumn('roles', function ($user) {
                return implode(', ', $user->roles->map(function ($role) {
                    return $role->name;
                })->toArray());
            })
            ->addColumn('status', 'admin.users.datatables.status')
            ->addColumn('action', 'admin.users.datatables.action')
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function getRolesList()
    {
        return $this->roles()->pluck('id')->toArray();
    }

    public function isActive()
    {
        return Activation::completed($this);
    }

    public function setActivation($active = true)
    {
        if ($active && ! $this->isActive()) {
            return $this->activate();
        }

        if (! $active) {
            return $this->deactivate();
        }

        return $this;
    }

    public function activate()
    {
        $activation = Activation::exists($this);

        if (! $activation) {
            $activation = Activation::create($this);
        }

        Activation::complete($this, $activation->code);

        return $this;
    }

    public function deactivate()
    {
        Activation::remove($this);

        return $this;
    }

    public function syncRoles($roleIds)
    {
        $this->roles()->sync($roleIds);

        return $this;
    }

    public function update(array $attributes = [], array $options = [])
    {
        if (empty($attributes['password'])) {
            unset($attributes['password']);
        }

        Sentinel::update($this, $attributes);

        return $this;
    }

    public function delete()
    {
        if ($this->id == Sentinel::getUser()->id) {
            throw new ModelShouldNotDeletedException('Cannot delete yourself.');
        }

        if ($this->isSuperAdmin()) {
            throw new ModelShouldNotDeletedException('Cannot delete Super Admin.');
        }

        return parent::delete();
    }

    public function isSuperAdmin()
    {
        return !! $this->is_superadmin;
    }

    public function grantPermissions($permissions)
    {
        dd($permissions);
        foreach ($permissions as $permission => $value) {
            $this->grantPermission($permission, $value);
        }

        $this->save();

        return $this;
    }

    protected function grantPermission($permission, $value)
    {
        return ($value == -1)
            ? $this->removePermission($permission)
            : $this->updatePermission($permission, !! $value, true);
    }
}
