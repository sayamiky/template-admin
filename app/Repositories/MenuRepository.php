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
        // Eager load relasi 'parent' untuk efisiensi
        $menus = Menu::with('parent')->orderBy('order', 'asc')->get();
        $menuTree = $this->buildTree($menus);
        return $this->flattenTree($menuTree);
    }

    /**
     * Membangun struktur pohon dari koleksi menu.
     *
     * @param \Illuminate\Database\Eloquent\Collection $elements
     * @param int|null $parentId
     * @return array
     */
    private function buildTree($elements, $parentId = null)
    {
        $branch = [];
        foreach ($elements as $element) {
            if ($element->parent_id == $parentId) {
                $children = $this->buildTree($elements, $element->id);
                if ($children) {
                    $element->setRelation('children', collect($children));
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }

    /**
     * Meratakan (flatten) struktur pohon menjadi array tunggal.
     *
     * @param array $tree
     * @param int $level
     * @param array $result
     * @return array
     */
    private function flattenTree($tree, $level = 0, &$result = [])
    {
        foreach ($tree as $item) {
            $item->level = $level; // Menambahkan properti 'level' untuk indentasi di view
            $result[] = $item;
            if ($item->relationLoaded('children') && !$item->children->isEmpty()) {
                $this->flattenTree($item->children, $level + 1, $result);
            }
        }
        return $result;
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
        return $menu->delete();
    }
}
