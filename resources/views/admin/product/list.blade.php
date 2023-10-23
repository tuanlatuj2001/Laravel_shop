@extends('layouts.admin')
@section('content')
    {{-- <base href="http://localhost/shop2t/"> --}}
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách sản phẩm</h5>
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
                    <a href="{{ request()->fullUrlWithQuery(['status1' => 0]) }}" class="text-primary" name="status1">Còn
                        hàng<span class="text-muted">({{ $count[2] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status1' => 1]) }}" class="text-primary" name="status1">Hết
                        hàng<span class="text-muted">({{ $count[1] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status1' => 2]) }}" class="text-primary">Tất cả<span
                            class="text-muted" name="status1">({{ $count[0] }})</span></a>
                </div>
                <div class="form-action form-inline py-3">
                    <form action="#">
                        <select class="form-control mr-1" id="" name="status">
                            <option>Chọn</option>
                            <option value="0">Còn hàng</option>
                            <option value="1">Hết hàng</option>
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
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Số lượng</th>

                            <th scope="col">Trạng thái</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $t = 0;
                        @endphp
                        @foreach ($products as $pr)
                            @php
                                $t++;
                            @endphp
                            <tr class="">
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td>{{ $t }}</td>
                                <td><img src=" {{ asset($pr->thumbnail) }} " class="img-responsive"
                                        style="max-height: 100px; max-width:100px;" alt=""></td>
                                <td><a href="#">{{ $pr->product_name }}</a></td>
                                <td>{{ $pr->price }}</td>
                                <td value="{{ $pr->catalog_id }}">{{ $pr->catalog_name }}</td>
                                <td>{{ $pr->stock_quantity }}</td>

                                <td><span
                                        class="badge {{ $pr->status == '1' ? 'badge-danger' : 'badge-success' }}">{{ $pr->status == '1' ? 'Chờ duyệt' : 'Công khai' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('edit.product', $pr->product_id) }}"
                                        class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fa fa-edit"></i></a>
                                    <a href="{{ route('delete.product', $pr->product_id) }}"
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
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
