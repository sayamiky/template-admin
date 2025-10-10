<?php

namespace App\Services;

use App\Repositories\MenuRepository;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class MenuService
{
    protected $repository;

    public function __construct(MenuRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getDataTable()
    {
        $data = $this->repository->getAll();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.menus.edit', $row->id);
                $deleteUrl = route('admin.menus.destroy', $row->id);
                $editBtn = '<a href="' . $editUrl . '" class="btn btn-sm btn-primary"><i class="ri-edit-line"></i></a>';

                $deleteBtn = '<button class="btn btn-sm btn-danger delete-btn" 
                                    data-url="' . $deleteUrl . '" 
                                    data-name="' . htmlspecialchars($row->name, ENT_QUOTES, 'UTF-8') . '"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteConfirmationModal">
                                    <i class="ri-delete-bin-line"></i>
                              </button>';

                return $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getAllMenus()
    {
        return $this->repository->getAll();
    }

    public function getTopMenus()
    {
        return $this->repository->getTopMenus();
    }

    public function createMenu(array $data)
    {
        if (!empty($data['parent_id'])) {
            if (!Menu::find($data['parent_id'])) {
                throw ValidationException::withMessages(['parent_id' => 'Parent menu tidak ditemukan']);
            }
        }

        if (!isset($data['order'])) {
            $data['order'] = Menu::where('parent_id', $data['parent_id'] ?? null)->max('order') + 1;
        }

        return DB::transaction(function () use ($data) {
            return $this->repository->create($data);
        });
    }

    public function updateMenu(Menu $menu, array $data)
    {
        if (isset($data['parent_id']) && $data['parent_id'] == $menu->id) {
            throw ValidationException::withMessages(['parent_id' => 'Menu tidak boleh menjadi parent dirinya sendiri']);
        }

        return DB::transaction(function () use ($menu, $data) {
            return $this->repository->update($menu, $data);
        });
    }


    public function deleteMenu(Menu $menu)
    {
        return $this->repository->delete($menu);
    }
}
