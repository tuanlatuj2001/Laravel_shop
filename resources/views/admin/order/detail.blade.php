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
                <h5 class="m-0 ">Chi tiết đơn hàng</h5>
                <div class="form-search form-inline">
                    <form action="#">
                        <input type="" class="form-control form-search" placeholder="Tìm kiếm" name="keyword"
                            value="{{ request()->input('keyword') }}">
                        <input type="submit" name="btn-search" value="Tìm " class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">

                <table class="table table-striped table-checkall">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mã đơn hàng</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá</th>
                            <th scope="col">PTTT</th>
                            <th scope="col">Ghi chú</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $t = 0;
                        @endphp
                        @foreach ($details as $order)
                            @php
                                $t++;
                            @endphp
                            <tr class="">

                                <td>{{ $t }}</td>
                                <td><a href="#">{{ $order->order_code }}</a></td>

                                <td>{{ $order->product_name }}</td>
                                <td>{{ $order->product_quantity }}</td>
                                <td>
                                    <span class="badge">
                                        {{ number_format($order->total_amount, '0', ',', '.') }}đ


                                    </span>
                                </td>
                                <td>{{ $order->payment_method }}</td>
                                <td>{{ $order->note }}</td>
                                <td>
                                    <a href="{{ route('edit_detail.order', $order->order_id) }}"
                                        class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fa fa-edit"></i></a>
                                    <a href="" class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Delete"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này?')"><i
                                            class="fa fa-trash"></i></a>
                                    {{-- @method('delete') --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $p->links() }} --}}
            </div>
        </div>
    </div>
@endsection
