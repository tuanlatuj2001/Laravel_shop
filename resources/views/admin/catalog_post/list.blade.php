@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('status_error'))
                        <div class="alert alert-danger">
                            {{ session('status_error') }}
                        </div>
                    @endif
                    <div class="card-header font-weight-bold">
                        Danh mục sản phẩm
                    </div>
                    @include('admin.catalog_post.add')

                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                        <div class="m-0 ">
                            Danh sách
                        </div>
                        <div class="form-search form-inline">
                            <form action="#">
                                <input type="text" name="keyword" class="form-control form-search"
                                    value="{{ request()->input('keyword') }}" placeholder="Tìm kiếm "
                                    style="margin-right:0px">
                                <input type="submit" value="Tìm" class="btn btn-primary ">

                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>

                                <tr>
                                    <th scope="col">Mã DM</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Danh mục cha</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($catalog_posts as $cat)
                                    <tr>
                                        <th scope="row">{{ $cat->catalog_post_id }}</th>
                                        <td>{{ str_repeat('---', $cat['level']) . $cat['catalog_post_name'] }}</td>
                                        <td>{{ $cat->parent_id }}</td>
                                        <td>
                                            <span
                                                class="badge {{ $cat->status == '1' ? 'badge-danger' : 'badge-success' }}">{{ $cat->status == '0' ? 'Công khai' : 'Chờ duyệt' }}</span>
                                        </td>
                                        <td>

                                            <a href="{{ route('edit.catalog_post', $cat->catalog_post_id) }}"
                                                class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></a>



                                            <a href="{{ route('delete.catalog_post', $cat->catalog_post_id) }}"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này?')"
                                                class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                    class="fa fa-trash"></i></a>

                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        {{-- {{ $cats->links() }} --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
