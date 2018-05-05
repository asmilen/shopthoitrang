<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes,HasUpdater;

    protected $dates = ['deleted_at'];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected $with = ['attributes'];

    /*public function products()
    {
        return $this->hasMany(Product::class);
    }*/

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class)->orderBy('slug', 'asc');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public static function getActiveList()
    {
        return static::active()->pluck('name', 'id')->all();
    }

}
