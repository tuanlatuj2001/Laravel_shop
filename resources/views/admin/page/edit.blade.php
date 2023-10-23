@extends('layouts.admin')
@section('content')
    {{-- <base href="http://localhost/shop2t/"> --}}
    <div id="content" class="container-fluid">
        <div class="card">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách trang</h5>
                <div class="form-search form-inline">
                    <form action="#">
                        <input type="" class="form-control form-search" placeholder="Tìm kiếm" name="keyword"
                            value="{{ request()->input('keyword') }}">
                        <input type="submit" name="btn-search" value="Tìm " class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="{{ request()->fullUrlWithQuery(['status1' => 0]) }}" class="text-primary" name="status1">Công
                        khai<span class="text-muted">({{ $count[2] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status1' => 1]) }}" class="text-primary" name="status1">Chờ
                        duyệt<span class="text-muted">({{ $count[1] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status1' => 2]) }}" class="text-primary">Tất cả<span
                            class="text-muted" name="status1">({{ $count[0] }})</span></a>
                </div>
                <div class="form-action form-inline py-3">
                    <form action="#">
                        <select class="form-control mr-1" id="" name="status">
                            <option>Chọn</option>
                            <option value="0">Công khai</option>
                            <option value="1">Chờ duyệt</option>
                        </select>
                        <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                    </form>
                </div>
                <table class="table table-striped table-checkall">
                    <thead>


                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $t = 0;
                        @endphp
                        @foreach ($pages as $pr)
                            @php
                                $t++;
                            @endphp
                            <tr class="">
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td>{{ $t }}</td>
                                <td><a href="#">{{ substr($pr->page_title, 0, 30) }}...</a></td>

                                <td>{{ substr($pr->page_slug, 0, 30) }}...</td>
                                <td>{{ $pr->created_at }}</td>
                                <td>
                                    <span
                                        class="badge {{ $pr->page_status == '1' ? 'badge-danger' : 'badge-success' }}">{{ $pr->page_status == '0' ? 'Công khai' : 'Chờ duyệt' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('edit.page', $pr->page_id) }}"
                                        class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fa fa-edit"></i></a>
                                    <a href="{{ route('delete.page', $pr->page_id) }}"
                                        class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Delete"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này?')"><i
                                            class="fa fa-trash"></i></a>
                                    @method('delete')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pages->links() }}
            </div>
        </div>
    </div>
@endsection
