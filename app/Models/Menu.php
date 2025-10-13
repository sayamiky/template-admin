<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Menu extends Model
{
    // Penggunaan trait HasRoles sudah benar. Trait ini secara otomatis
    // akan menyediakan relasi 'permissions()' yang dibutuhkan.
    use HasFactory, HasRoles;

    protected $fillable = [
        'name',
        'parent_id',
        'route',
        'icon',
        'order',
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

    /**
     * HAPUS METODE INI.
     * Metode permissions() sudah disediakan oleh trait HasRoles (yang memuat HasPermissions).
     * Mendefinisikannya ulang di sini, apalagi dengan tipe relasi yang mungkin salah (belongsToMany vs morphToMany),
     * adalah penyebab utama dari error 'RelationNotFoundException'.
     *
     * public function permissions()
     * {
     * return $this->belongsToMany(\Spatie\Permission\Models\Permission::class);
     * }
     */
}
