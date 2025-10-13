<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Menu extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'name',
        'parent_id',
        'route',
        'icon',
        'order',
        'is_active',
        'parent_id',
        'permission_name'
    ];

    /**
     * Get the parent for the menu.
     */
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /**
     * Get the children for the menu.
     */
    public function children()
    {
        // Perbaikan dari error 'Out of Memory':
        // Pastikan tidak ada ->with('children') di sini untuk menghindari rekursi tak terbatas.
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order', 'asc');
    }

}
