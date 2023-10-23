@extends('layouts.site')
@section('content')
    <div id="main-content-wp" class="checkout-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="?page=home" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Thanh toán</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    <form method="POST" action="{{ url('/thanh-toan/add') }}" name="form-checkout">
                        @csrf
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="fullname">Họ tên</label>
                                <input type="text" name="fullname" id="fullname">
                            </div>
                            <div class="form-col fl-right">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email">
                            </div>
                        </div>
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="address">Địa chỉ</label>
                                <input type="text" name="shipping_address" id="address">
                            </div>
                            <div class="form-col fl-right">
                                <label for="phone">Số điện thoại</label>
                                <input type="tel" name="phone_number" id="phone">
                            </div>
                        </div>
                        <div class="form-row  ">
                            <div class="form-col ">
                                <label for="notes">Ghi chú</label>
                                <textarea name="note" cols="79"></textarea>
                            </div>
                        </div>

                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::content() as $row)
                                <tr class="cart-item">
                                    <td class="product-name">{{ $row->name }}<strong class="product-quantity">x
                                            {{ $row->qty }}</strong>
                                    </td>
                                    <td class="product-total">{{ number_format($row->total, 0, ',', '.') }}đ</td>
                                </tr>
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng:</td>
                                <td><strong class="total-price"</strong> {{ Cart::total() }}đ</td>
                            </tr>
                        </tfoot>
                        @endforeach
                    </table>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" name="payment_method" value="COD">
                                <label for="direct-payment">Thanh toán khi nhận hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment_method" value="Online Payment">
                                <label for="payment-home">Thanh toán online</label>
                            </li>
                        </ul>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" name="submit" id="order-now" value="Đặt hàng">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
