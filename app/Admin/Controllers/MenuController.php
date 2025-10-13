<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Services\MenuService;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $service;

    public function __construct(MenuService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->getDataTable();
        }
        return view('admin.menu.index');
    }

    public function create()
    {
        $parents = $this->service->getTopMenus();
        return view('admin.menu.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'icon' => 'required|string|max:50',
            'route' => 'required|string|max:100',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);
        
        $this->service->createMenu($validated);
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dibuat.');
    }

    public function edit(Menu $menu)
    {
        $parents = $this->service->getTopMenus();
        return view('admin.menu.edit', compact('menu', 'parents'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'icon' => 'required|string|max:50',
            'route' => 'required|string|max:100',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $this->service->updateMenu($menu, $validated);
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        try {
            $this->service->deleteMenu($menu);
            return response()->json(['success' => 'Menu berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus data.'], 500);
        }
    }
}
