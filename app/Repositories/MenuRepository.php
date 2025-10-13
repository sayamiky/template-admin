<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuRepository
{
    /**
     * Mengambil semua menu, membangun struktur pohon, lalu meratakannya (flatten)
     * menjadi satu array yang terurut untuk ditampilkan di view.
     *
     * @return array
     */
    public function getAllMenusOrderedHierarchically()
    {
        return Menu::whereNull('parent_id')
            ->with(['children' => function ($query) {
                $query->orderBy('order', 'asc');
            }])
            ->orderBy('order', 'asc')
            ->get();
    }

    public function getAll()
    {
        return Menu::with('children')->orderBy('order')->get();
    }

    public function getTopMenus()
    {
        return Menu::active()->whereNull('parent_id')->with('children')->orderBy('order')->get();
    }

    public function find($id)
    {
        return Menu::findOrFail($id);
    }

    public function create(array $data)
    {
        return Menu::create($data);
    }

    public function update(Menu $menu, array $data)
    {
        $menu->update($data);
        return $menu;
    }

    public function delete(Menu $menu)
    {
        if ($menu->children()->count() > 0) {
            $menu->children()->delete();
        }
        return $menu->delete();
    }
}
