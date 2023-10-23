<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'page']);
            return $next($request);
        });
    }

    function add()
    {
        return view('admin/page/add');
    }

    function store(Request $request)
    {
        $request->validate(
            [
                'page_title' => ['required', 'string', 'max:255'],
                'page_content' => ['required'],
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'page_title' => 'Tiêu đề trang',
                'page_content' => 'Nội dung trang',
            ],
        );

        Page::create([
            'page_title' => $request->page_title,
            'page_content' => $request->page_content,
            'page_status' => $request->page_status,
            'page_slug' => str_slug($request->page_title, '-'),
            'user_id' => Auth::id(),
        ]);
        return redirect('/admin/page/list')->with('status', 'Đã tạo trang thành công');
    }

    function list(Request $request)
    {
        $keyword = '';
        $pages = $request->input('status1');

        if ($pages == '1') {
            $pages = Page::where('page_status', 1)->paginate(5);
        } elseif ($pages == '0') {
            $pages = Page::where('page_status', 0)->paginate(5);
        } elseif ($pages == '2') {
            $pages = DB::table('pages')
                ->where('page_title', 'LIKE', '%' . $keyword . '%')
                ->paginate(5);
        } else {
            $keyword = $request->input('keyword');
            $pages = DB::table('pages')
                ->where('page_title', 'LIKE', '%' . $keyword . '%')
                ->paginate(5);
        }
        $count1 = Page::count();
        $count2 = Page::where('page_status', 1)->count();
        $count3 = Page::where('page_status', 0)->count();
        $count = [$count1, $count2, $count3];

        return view('admin.page.list', compact('pages', 'count'));
    }

    function edit($id)
    {
        $page = Page::find($id);

        return view('admin.page.edit', compact('page'));
    }

    function update(Request $request, $id)
    {
        $pages = Page::find($id);
        $request->validate(
            [
                'page_title' => ['required', 'string', 'max:255'],
                'page_content' => ['required'],
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'page_title' => 'Tiêu đề trang',
                'page_content' => 'Nội dung trang',
            ],
        );

        $pages->update([
            'page_title' => $request->page_title,
            'page_content' => $request->page_content,
            'page_status' => $request->page_status,
            'page_slug' => str_slug($request->page_title, '-'),
            'user_id' => Auth::id(),
        ]);
        return redirect('/admin/page/list')->with('status', 'Đã cập nhật trang thành công');
    }

    function delete($id)
    {
        $page = Page::find($id);
        $page->delete();
        return redirect('/admin/page/list')->with('status', 'Đã xóa trang thành công');
    }
}