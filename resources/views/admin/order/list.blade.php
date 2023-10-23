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
                <h5 class="m-0 ">Danh sách đơn hàng</h5>
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
                    <a href="{{ request()->fullUrlWithQuery(['status1' => 1]) }}" class="text-primary" name="status1">Chờ xử
                        lý<span class="text-muted">({{ $count[1] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status1' => 2]) }}" class="text-primary" name="status1">Đang
                        xử lý
                        <span class="text-muted">({{ $count[2] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status1' => 3]) }}" class="text-primary" name="status1">Vận
                        chuyển
                        <span class="text-muted">({{ $count[3] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status1' => 4]) }}" class="text-primary" name="status1">Đã
                        giao
                        <span class="text-muted">({{ $count[4] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status1' => 5]) }}" class="text-primary" name="status1">Đã
                        hủy
                        <span class="text-muted">({{ $count[5] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status1' => 6]) }}" class="text-primary">Tất cả<span
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
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $t = 0;
                        @endphp
                        @foreach ($p as $order)
                            @php
                                $t++;
                            @endphp
                            <tr class="">
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td>{{ $t }}</td>
                                <td><a href="#">{{ $order->order_code }}</a></td>

                                <td>{{ $order->fullname }}</td>
                                <td>{{ number_format($order->price_item, 0, ',', '.') }}đ</td>
                                <td>
                                    <span class="badge">
                                        {{ $order->order_status }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    <a href="{{ route('edit.order', $order->item_id) }}"
                                        class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fa fa-edit"></i></a>
                                    <a href="{{ route('detail.order', $order->order_code) }}"
                                        class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Delete"><i
                                            class="fa fa-eye"></i></a>
                                    {{-- @method('delete') --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $p->links() }}
            </div>
        </div>
    </div>
@endsection
