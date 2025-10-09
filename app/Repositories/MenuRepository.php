<?php

namespace App\Repositories;

use App\Models\Menu;

class MenuRepository
{
    public function getAll()
    {
        return Menu::with('children')->orderBy('order')->get();
    }

    public function getTopMenus()
    {
        return Menu::whereNull('parent_id')->with('children')->orderBy('order')->get();
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
        return $menu->delete();
    }
}
