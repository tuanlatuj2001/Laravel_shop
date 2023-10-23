<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'catalog']);
            return $next($request);
        });
    }
    function list(Request $request)
    {
        $catalogs = data_tree(Catalog::all());
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $cats = Catalog::where('catalog_name', 'LIKE', '%' . $keyword . '%')->paginate(5);

        return view('admin.catalog.list', compact('cats', 'catalogs'));
    }

    function add()
    {
        $catalogs = data_tree(Catalog::all());
        return view('admin.catalog.add', compact('catalogs'));
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'catalog_name' => ['required', 'unique:catalogs'],
                'parent_id' => ['required'],
                'status' => ['required'],
            ],
            [
                'required' => ':attribute không được để trống',
                'unique' => 'Danh mục đã tồn tại',
            ],
            [
                'catalog_name' => 'Tên người dùng',
                'parent_id' => 'Danh mục cha',
                'status' => 'Trạng thái',
            ],
        );
        Catalog::create([
            'catalog_name' => $request['catalog_name'],
            'parent_id' => $request['parent_id'],
            'status' => $request['status'],
            'cat_slug' => str_slug($request->catalog_name, '-'),
        ]);

        return redirect('admin/catalog/list')->with('status', 'Đã thêm thành viên thành công');
    }

    function edit($catalog_id)
    {
        $catalogs = data_tree(Catalog::all());
        $cat = Catalog::find($catalog_id);
        return view('admin.catalog.edit', compact('catalogs', 'cat'));
    }

    function update(Request $request, $catalog_id)
    {
        $request->validate(
            [
                'catalog_name' => ['required'],
                'parent_id' => ['required', 'different:id'],
                'status' => ['required'],
            ],
            [
                'required' => ':attribute không được để trống',
                'different' => 'asas',
            ],
            [
                'catalog_name' => 'Tên người dùng',
                'parent_id' => 'Danh mục cha',
                'status' => 'Trạng thái',
            ],
        );
        if ($request->input('parent_id') == $catalog_id) {
            return redirect('admin/catalog/list')->with('status_error', 'Không thể chọn lại danh mục này');
        } else {
            Catalog::find($catalog_id)->update([
                'catalog_name' => $request['catalog_name'],
                'parent_id' => $request['parent_id'],
                'status' => $request['status'],
                'cat_slug' => str_slug($request->catalog_name, '-'),
            ]);

            return redirect('admin/catalog/list')->with('status', 'Đã cập nhật thông thông tin thành công');
        }
    }

    function delete($catalog_id)
    {
        $cat = Catalog::where('catalog_id', $catalog_id);
        if ($cat) {
            $uncat = 23;
            Catalog::where('parent_id', $catalog_id)->update([
                'parent_id' => $uncat,
            ]);
            Product::where('cat_id', $catalog_id)->update([
                'cat_id' => $uncat,
            ]);
            Catalog::where('catalog_id', $catalog_id)->delete();
        }
        return redirect('admin/catalog/list')->with('status', 'Đã xóa danh mục thành công');
    }
}