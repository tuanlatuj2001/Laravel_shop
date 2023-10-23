@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Cập nhật đơn hàng
            </div>
            <div class="card-body">
                <form action="{{ route('order.update', $p->item_id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Mã đơn hàng</label>
                        <input class="form-control" type="text" name="order_code" id="name"
                            value="{{ $p->order_code }}">
                        @error('order_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Khách hàng</label>
                        <input class="form-control" type="text" name="customer_id" id="name"
                            value="{{ $p->customer_id }}">
                        @error('customer_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Giá</label>
                        <input class="form-control" type="text" name="price_item" id="price_item"
                            value="{{ $p->price_item }}">
                        @error('price_item')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <select class="form-control" id="" name="order_status">
                            <option value="">Chọn trạng thái</option>
                            <option value="pending" {{ $p->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $p->order_status == 'processing' ? 'selected' : '' }}>Processing
                            </option>
                            <option value="shipped" {{ $p->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $p->order_status == 'delivered' ? 'selected' : '' }}>Delivered
                            </option>
                            <option value="canceled" {{ $p->order_status == 'canceled' ? 'selected' : '' }}>Canceled
                            </option>
                        </select>
                        @error('order_status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" value="update" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection
