<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'user']);
            return $next($request);
        });
    }
    //List
    function list(Request $request)
    {
        $status = $request->input('status');
        $list_act = [
            'delete' => 'Xóa tạm thời',
        ];
        if ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn',
            ];
            $users = User::onlyTrashed()->paginate(10);
        } else {
            $keyword = '';
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $users = User::where('name', 'LIKE', '%' . $keyword . '%')->paginate(10);
        }
        $count_user_active = User::count();
        $count_user_trash = User::onlyTrashed()->count();

        $count = [$count_user_active, $count_user_trash];
        return view('admin.user.list', compact('users', 'count', 'list_act'));
    }

    //Add
    function add()
    {
        return view('admin.user.add');
    }

    //Store
    function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài tối thiểu :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên người dùng',
                'emai' => 'Email',
                'password' => 'Mật khẩu',
            ],
        );
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect('admin/user/list')->with('status', 'Đã thêm thành viên thành công');
    }

    //Delete
    function delete($id)
    {
        if (Auth::id() != $id) {
            $user = User::find($id);
            $user->delete();
            return redirect('admin/user/list')->with('status', 'Đã xóa thành viên thành công');
        } else {
            return redirect('admin/user/list')->with('status', 'Bạn không thể tự xóa mình ra khỏi hệ thống');
        }
    }

    //Action
    function action(Request $request)
    {
        $list_check = $request->input('list_check');
        if ($list_check) {
            foreach ($list_check as $k => $id) {
                if (Auth::id() == $id) {
                    usset($list_check[$k]);
                }
            }
            if (!empty($list_check)) {
                $act = $request->input('act');
                if ($act == 'delete') {
                    User::destroy($list_check);
                    return redirect('admin/user/list')->with('status', 'Bạn đã xóa thành công');
                }

                if ($act == 'restore') {
                    User::withTrashed()
                        ->WhereIn('id', $list_check)
                        ->restore();

                    return redirect('admin/user/list')->with('status', 'Bạn đã khôi phục thành công');
                }
                if ($act == 'forceDelete') {
                    User::withTrashed()
                        ->WhereIn('id', $list_check)
                        ->forceDelete();

                    return redirect('admin/user/list')->with('status', 'Bạn đã xóa vĩnh viễn bản ghi thành công');
                }
            }
            return redirect('admin/user/list')->with('status', 'Bạn Không thể thao tác trên tài khoản của bạn');
        } else {
            return redirect('admin/user/list')->with('status', 'Bạn cần chọn phần tử để thực hiện tác vụ này');
        }
    }

    //Edit
    function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    //Update
    function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài tối thiểu :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
            ],
            [
                'name' => 'Tên người dùng',
                'password' => 'Mật khẩu',
            ],
        );

        User::where('id', $id)->update([
            'name' => $request['name'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect('admin/user/list')->with('status', 'Đã cập nhật thông thông tin thành công');
    }
}