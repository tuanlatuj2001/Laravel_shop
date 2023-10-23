@extends('layouts.site')
@section('content')
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <div class="item">
                        <img src="{{ url('public/site') }}/images/slider-01.png" alt="">
                    </div>
                    <div class="item">
                        <img src="{{ url('public/site') }}/images/slider-02.png" alt="">
                    </div>
                    <div class="item">
                        <img src="{{ url('public/site') }}/images/slider-03.png" alt="">
                    </div>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="{{ url('public/site') }}/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{ url('public/site') }}/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{ url('public/site') }}/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{ url('public/site') }}/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="{{ url('public/site') }}/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>

                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($is_featureds as $is_featured)
                            <li>

                                <a href="{{ route('detail', $is_featured->slug) }}" title="" class="thumb">
                                    <img src="{{ asset($is_featured->thumbnail) }}">
                                </a>
                                <a href="?page=detail_product" title=""
                                    class="product-name">{{ $is_featured->product_name }}
                                </a>
                                <div class="price">
                                    <span class="new">{{ number_format($is_featured->price, 0, ',', '.') }}đ</span>

                                </div>
                                <div class="action clearfix">
                                    <a href="{{ route('cart.add', $is_featured->product_id) }}" title=""
                                        class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="{{ route('cart.add', $is_featured->product_id) }}" title=""
                                        class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Điện thoại</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach ($dt as $d)
                            <li>
                                <a href="{{ route('detail', $d->slug) }}" title="" class="thumb">
                                    <img src="{{ asset($d->thumbnail) }}">
                                </a>
                                <a href="?page=detail_product" title=""
                                    class="product-name">{{ $d->product_name }}</a>
                                <div class="price">
                                    <span class="new">{{ number_format($d->price, 0, ',', '.') }}đ</span>

                                </div>
                                <div class="action clearfix">
                                    <a href="{{ route('cart.add', $d->product_id) }}" title="Thêm giỏ hàng"
                                        class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="{{ route('cart.add', $d->product_id) }}" title="Mua ngay"
                                        class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Laptop</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach ($lt as $l)
                            <li>
                                <a href="{{ route('detail', $l->slug) }}" title="" class="thumb">
                                    <img src="{{ asset($l->thumbnail) }}">
                                </a>
                                <a href="?page=detail_product" title=""
                                    class="product-name">{{ $l->product_name }}</a>
                                <div class="price">
                                    <span class="new">{{ number_format($l->price, 0, ',', '.') }}đ</span>

                                </div>
                                <div class="action clearfix">
                                    <a href="{{ route('cart.add', $l->product_id) }}" title="Thêm giỏ hàng"
                                        class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="{{ route('cart.add', $l->product_id) }}" title="Mua ngay"
                                        class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            @include('components.main_menu')
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    @foreach ($is_featureds as $is_featured)
                        <ul class="list-item">
                            <li class="clearfix">
                                <a href="{{ route('detail', $is_featured->slug) }}" title=""
                                    class="thumb fl-left">
                                    <img src="{{ asset($is_featured->thumbnail) }}" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="?page=detail_product" title=""
                                        class="product-name">{{ $is_featured->product_name }}</a>
                                    <div class="price">
                                        <span class="new">{{ number_format($is_featured->price, 0, ',', '.') }}đ</span>

                                    </div>
                                    <a href="{{ route('cart.add', $is_featured->product_id) }}" title=""
                                        class="buy-now">Mua ngay</a>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
