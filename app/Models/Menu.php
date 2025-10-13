<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'route',
        'icon',
        'order',
        'is_active',
        'parent_id',
        'permission_name'
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }

    public function roles()
    {
        return $this->belongsToMany(\Spatie\Permission\Models\Role::class, 'menu_role', 'menu_id', 'role_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
