<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Services\MenuService;
use App\Models\Menu;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
            $menus = $this->service->getParentMenusWithChildren();

            return DataTables::of($menus)
                ->addIndexColumn()
                ->addColumn('menu_name', function ($menu) {
                    // --- Bagian Parent Menu ---
                    $parent_html = '';
                    if ($menu->icon) {
                        $parent_html .= '<i class="' . $menu->icon . ' me-2"></i>';
                    }
                    $parent_html .= '<strong>' . $menu->name . '</strong>';
                    if ($menu->children->isNotEmpty()) {
                        $parent_html .= '&nbsp;<span class="badge rounded-pill bg-label-secondary">Parent</span>';
                    }

                    // --- Bagian Child Menu (jika ada) ---
                    $children_html = '';
                    if ($menu->children->isNotEmpty()) {
                        $children_html .= '<ul class="list-unstyled ps-4 mt-2">';
                        foreach ($menu->children as $child) {
                            $child_name = '';
                            if ($child->icon) {
                                $child_name .= '<i class="' . $child->icon . ' me-2"></i>';
                            }
                            $child_name .= $child->name;

                            $child_actions = $this->getInlineActionButtons($child);

                            $children_html .= '<li>';
                            $children_html .= '<div class="d-flex justify-content-between align-items-center">';
                            $children_html .= '<span>' . $child_name . '</span>';
                            $children_html .= '<span class="d-inline-block">' . $child_actions . '</span>';
                            $children_html .= '</div>';
                            $children_html .= '</li>';
                        }
                        $children_html .= '</ul>';
                    }

                    return $parent_html . $children_html;
                })
                ->addColumn('route', function ($menu) {
                    if ($menu->route) {
                        return '<span class="badge bg-label-info">' . $menu->route . '</span>';
                    }
                    return '-';
                })
                ->addColumn('order', function ($menu) {
                    return '<div class="text-center">' . $menu->order . '</div>';
                })
                ->addColumn('status', function ($menu) {
                    $badge = $menu->is_active
                        ? '<span class="badge bg-label-success">Aktif</span>'
                        : '<span class="badge bg-label-danger">Tidak Aktif</span>';
                    return '<div class="text-center">' . $badge . '</div>';
                })
                ->addColumn('action', function ($menu) {
                    // Tombol aksi hanya untuk parent
                    return $this->getParentActionButtons($menu);
                })
                ->rawColumns(['menu_name', 'route', 'order', 'status', 'action'])
                ->make(true);
        }

        return view('admin.menu.index');
    }

    /**
     * Helper untuk tombol aksi inline (untuk child menu).
     */
    private function getInlineActionButtons(Menu $menu): string
    {
        $editUrl = route('admin.menus.edit', $menu->id);
        $deleteUrl = route('admin.menus.destroy', $menu->id);
        $menuName = htmlspecialchars($menu->name, ENT_QUOTES, 'UTF-8');

        $editButton = '<a href="' . $editUrl . '" class="btn btn-sm btn-warning m-1"><i class="ri-pencil-line"></i></a>';
        $deleteButton = '<button type="button" class="btn btn-sm btn-danger" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteConfirmationModal" 
                            data-url="' . $deleteUrl . '" 
                            data-menu-name="' . $menuName . '">
                            <i class="ri-delete-bin-line"></i>
                        </button>';
        return $editButton . $deleteButton;
    }

    /**
     * Helper untuk tombol aksi di kolom 'Aksi' (untuk parent menu).
     */
    private function getParentActionButtons(Menu $menu): string
    {
        $editUrl = route('admin.menus.edit', $menu->id);
        $deleteUrl = route('admin.menus.destroy', $menu->id);
        $menuName = htmlspecialchars($menu->name, ENT_QUOTES, 'UTF-8');

        $editButton = '<a href="' . $editUrl . '" class="btn btn-sm btn-warning m-1"><i class="ri-pencil-line"></i></a>';
        $deleteButton = '<button type="button" class="btn btn-sm btn-danger" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteConfirmationModal" 
                            data-url="' . $deleteUrl . '" 
                            data-menu-name="' . $menuName . '">
                            <i class="ri-delete-bin-line"></i>
                        </button>';

        return '<div class="text-center">' . $editButton . $deleteButton . '</div>';
    }

    public function create()
    {
        $parents = Menu::whereNull('parent_id')->where('is_active', 1)->get();
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
            'permission_name' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $this->service->createMenu($validated);
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dibuat.');
    }

    public function edit(Menu $menu)
    {
        $parents = Menu::whereNull('parent_id')
            ->where('id', '!=', $menu->id) // Mencegah sebuah menu menjadi parent dari dirinya sendiri
            ->where('is_active', 1)
            ->get();
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
            'permission_name' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $this->service->updateMenu($menu, $validated);
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        $this->service->deleteMenu($menu);
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}
