@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Cập nhật đơn hàng
            </div>
            <div class="card-body">
                <form action="{{ route('order.update_detail', $details->order_id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Mã đơn hàng</label>
                        <input class="form-control" type="text" name="order_code" id="name"
                            value="{{ $details->order_code }}">
                        @error('order_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Sản phẩm</label>
                        <input class="form-control" type="text" name="product_id" id="name"
                            value="{{ $details->product_id }}">
                        @error('product_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Số lượng</label>
                        <input class="form-control" type="text" name="product_quantity" id="name"
                            value="{{ $details->product_quantity }}">
                        @error('product_quantity')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Giá</label>
                        <input class="form-control" type="text" name="total_amount" id="total_amount"
                            value="{{ $details->price }}">
                        @error('total_amount')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Ghi chú</label>
                        <input class="form-control" type="text" name="note" id="note"
                            value="{{ $details->note }}">
                        @error('note')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Địa điểm giao hàng</label>
                        <input class="form-control" type="text" name="shipping_address" id="shipping_address	"
                            value="{{ $details->shipping_address }}">
                        @error('shipping_address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Ngày đặt hàng</label>
                        <input class="form-control" type="text" name="order_date" id="order_date"
                            value="{{ $details->order_date }}">
                        @error('order_date')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Hình thức thanh toán</label>
                        <select class="form-control" id="" name="payment_method">
                            <option value="">Chọn trạng thái</option>
                            <option value="COD" {{ $details->payment_method == 'COD' ? 'selected' : '' }}>COD
                            </option>
                            <option value="Online Payment"
                                {{ $details->payment_method == 'Online Payment' ? 'selected' : '' }}>
                                Online Payment
                            </option>
                        </select>
                        @error('payment_method')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" value="update" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection
