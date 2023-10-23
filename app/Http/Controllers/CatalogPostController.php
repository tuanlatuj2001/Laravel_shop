<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Catalog_post;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatalogPostController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'catalog_post']);
            return $next($request);
        });
    }
    function list(Request $request)
    {
        $catalog_posts = data_catalog_post(Catalog_post::all());
        $keyword = '';
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $cats = Catalog_post::where('catalog_post_name', 'LIKE', '%' . $keyword . '%')->paginate(5);

        return view('admin.catalog_post.list', compact('cats', 'catalog_posts'));
    }

    function add()
    {
        $catalog_posts = data_catalog_post(Catalog_post::all());
        return view('admin.catalog_post.add', compact('catalog_posts'));
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'catalog_post_name' => ['required', 'unique:catalog_posts'],
                'parent_id' => ['required'],
                'status' => ['required'],
            ],
            [
                'required' => ':attribute không được để trống',
                'unique' => 'Danh mục đã tồn tại',
            ],
            [
                'catalog_post_name' => 'Tên danh mục',
                'parent_id' => 'Danh mục cha',
                'status' => 'Trạng thái',
            ],
        );
        Catalog_post::create([
            'catalog_post_name' => $request['catalog_post_name'],
            'parent_id' => $request['parent_id'],
            'user_id' => Auth::id(),
            'status' => $request['status'],
        ]);

        return redirect('admin/catalog_post/list')->with('status', 'Đã thêm danh mục thành công');
    }

    function edit($catalog_post_id)
    {
        $catalogs = data_catalog_post(Catalog_post::all());
        $cat = Catalog_post::find($catalog_post_id);
        return view('admin.catalog_post.edit', compact('catalogs', 'cat'));
    }

    function update(Request $request, $catalog_post_id)
    {
        $request->validate(
            [
                'catalog_post_name' => ['required'],
                'parent_id' => ['required'],
                'status' => ['required'],
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'catalog_post_name' => 'Tên danh mục',
                'parent_id' => 'Danh mục cha',
                'status' => 'Trạng thái',
            ],
        );

        if ($request->input('parent_id') == $catalog_post_id) {
            return redirect('admin/catalog_post/list')->with('status_error', 'Không thể chọn lại danh mục này');
        } else {
            Catalog_post::find($catalog_post_id)->update([
                'catalog_post_name' => $request['catalog_post_name'],
                'parent_id' => $request['parent_id'],
                'status' => $request['status'],
            ]);

            return redirect('admin/catalog_post/list')->with('status', 'Đã cập nhật thông thông tin thành công');
        }
    }

    function delete($catalog_post_id)
    {
        $cat = Catalog::where('catalog_post_id', $catalog_post_id);
        if ($cat) {
            $uncat = 7;
            Catalog_post::where('parent_id', $catalog_post_id)->update([
                'parent_id' => $uncat,
            ]);
            Post::where('catalog_posts_id', $catalog_post_id)->update([
                'catalog_posts_id' => $uncat,
            ]);
            Catalog_post::where('catalog_post_id', $catalog_post_id)->delete();
        }
        return redirect('admin/catalog_post/list')->with('status', 'Đã xóa danh mục thành công');
    }
}