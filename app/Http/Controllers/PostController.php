<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Catalog_post;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use File;

class PostController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'post']);
            return $next($request);
        });
    }
    function add()
    {
        $cats = Catalog_post::all();
        return view('admin/post/add', compact('cats'));
    }

    function store(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'post_title' => ['required', 'string', 'max:255'],
                'post_excerpt' => ['required'],
                'post_content' => ['required'],
                'catalog_posts_id' => ['required'],
                'thumbnail' => ['required', 'mimes:jpg,png, jpeg, gif'],
            ],
            [
                'required' => ':attribute không được để trống',
                // 'image' => 'Ảnh đại diện phải là file hình ảnh',
                'mimes' => 'Ảnh đại diện là tệp định dạng có đuôi jpg, png, jpeg, gif',

                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'post_title' => 'Tiêu đề bài viết',
                'post_excerpt' => 'Mô tả ngắn',
                'post_content' => 'Nội dung bài viết',
                'catalog_posts_id' => 'Danh mục bài viết',
                'thumbnail' => 'Ảnh đại diện',
                'catalog_posts_id' => 'Danh mục bài viết',
            ],
        );
        // dd($request->hasfile('thumbnail'));
        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            $imageName = 'thumbnail/' . time() . '_' . $file->getClientOriginalName();
            $file->move('public/thumbnail', $imageName);

            $post = Post::create([
                'post_title' => $request->post_title,
                'post_excerpt' => $request->post_excerpt,
                'post_content' => $request->post_content,
                'post_status' => $request->status,
                'thumbnail_post' => $imageName,
                'post_slug' => str_slug($request->post_title, '-'),
                'user_id' => Auth::id(),
                'catalog_posts_id' => $request->catalog_posts_id,
            ]);

            return redirect('/admin/post/list')->with('status', 'Đã tạo bài viêt thành công');
        }
    }

    function list(Request $request)
    {
        $keyword = '';
        $posts = $request->input('status1');

        if ($posts == '1') {
            $posts = Post::where('post_status', 1)->paginate(5);
        } elseif ($posts == '0') {
            $posts = Post::where('post_status', 0)->paginate(5);
        } elseif ($posts == '2') {
            $posts = DB::table('catalog_posts')
                ->join('posts', 'posts.catalog_posts_id', '=', 'catalog_posts.catalog_post_id')
                ->select('posts.*', 'catalog_posts.catalog_post_id', 'catalog_posts.catalog_post_name')
                ->where('posts.post_title', 'LIKE', '%' . $keyword . '%')
                ->orwhere('catalog_posts.catalog_post_name', 'LIKE', '%' . $keyword . '%')
                ->paginate(5);
        } else {
            $keyword = $request->input('keyword');
            $posts = DB::table('catalog_posts')
                ->join('posts', 'posts.catalog_posts_id', '=', 'catalog_posts.catalog_post_id')
                ->select('posts.*', 'catalog_posts.catalog_post_id', 'catalog_posts.catalog_post_name')
                ->where('posts.post_title', 'LIKE', '%' . $keyword . '%')
                ->orwhere('catalog_posts.catalog_post_name', 'LIKE', '%' . $keyword . '%')
                ->paginate(5);
        }
        $count1 = Post::count();
        $count2 = Post::where('post_status', 1)->count();
        $count3 = Post::where('post_status', 0)->count();
        $count = [$count1, $count2, $count3];

        $post_edit = Post::All();
        return view('admin.post.list', compact('posts', 'count', 'post_edit'));
    }
    function edit($id)
    {
        $post = Post::find($id);
        $cats = Catalog_post::All();
        return view('admin.post.edit', compact('post', 'cats'));
    }

    function update(Request $request, $id)
    {
        $posts = Post::findOrFail($id);
        if ($request->hasFile('thumbnail')) {
            if (File::exists('public/' . $posts->thumbnail_post)) {
                File::delete('public/' . $posts->thumbnail_post);
            }
            $file = $request->file('thumbnail');
            $posts->thumbnail_post = 'thumbnail/' . time() . '_' . $file->getClientOriginalName();
            $file->move('public/thumbnail', $posts->thumbnail_post);
            $request['thumbnail'] = $posts->thumbnail_post;
        }
        $posts->update([
            'post_title' => $request->post_title,
            'post_excerpt' => $request->post_excerpt,
            'post_content' => $request->post_content,
            'post_status' => $request->status,
            'thumbnail_post' => $posts->thumbnail_post,
            'post_slug' => str_slug($request->post_title, '-'),
            'user_id' => Auth::id(),
            'catalog_posts_id' => $request->catalog_posts_id,
        ]);
        return redirect('/admin/post/list')->with('status', 'Đã cập nhật bài viêt thành công');
    }

    function delete($id)
    {
        $post = Post::findOrFail($id);
        $thumb = 'public/' . $post->thumbnail_post;
        if (File::exists($thumb)) {
            File::delete($thumb);
        }

        $post->delete();
        return redirect('/admin/post/list')->with('status', 'Đã xóa bài viêt thành công');
    }
}