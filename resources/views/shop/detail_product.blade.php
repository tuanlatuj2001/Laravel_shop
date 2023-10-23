@extends('layouts.site')
@section('content')
    <div id="main-content-wp" class="clearfix detail-product-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Điện thoại</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="detail-product-wp">
                    <div class="section-detail clearfix">
                        <div class="thumb-wp fl-left">
                            <a href="" title="" id="main-thumb">
                                <img id="zoom" src="{{ asset($details->thumbnail) }}"
                                    data-zoom-image="{{ asset($details->thumbnail) }}" />
                            </a>
                            <div id="list-thumb">
                                <a href="" data-image="{{ asset($details->thumbnail) }}"
                                    data-zoom-image="{{ asset($details->thumbnail) }}">
                                    <img id="zoom" src="{{ asset($details->thumbnail) }}" />
                                </a>
                                @foreach ($details->images as $item)
                                    <a href="" data-image="{{ asset($item->image) }}"
                                        data-zoom-image="{{ asset($item->image) }}">
                                        <img id="zoom" src="{{ asset($item->image) }}" />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            <img src="public/images/img-pro-01.png" alt="">
                        </div>
                        <div class="info fl-right">
                            <h3 class="product-name">{{ $details->product_name }} </h3>
                            <div class="desc">
                                <p>{!! $details->desc !!}</p>

                            </div>
                            <div class="num-product">
                                <span class="title">Sản phẩm: </span>
                                <span class="status">{{ $details->stock_quantity == '0' ? 'Hết hàng' : 'Còn hàng' }}</span>
                            </div>
                            <p class="price">{{ number_format($details->price, 0, ',', '.') }}đ</p>
                            <div id="num-order-wp">
                                <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                <input type="text" name="num-order" value="1" id="num-order">
                                <a title="" id="plus"><i class="fa fa-plus"></i></a>
                            </div>
                            <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a>
                        </div>
                    </div>
                </div>
                <div class="section" id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">THÔNG TIN CHI TIẾT</h3>
                    </div>
                    <div class="section-detail">
                        {!! $details->product_datail !!}
                    </div>
                </div>


                <div class="section" id="same-category-wp">
                    <div class="section-head">
                        <h3 class="section-title">Cùng chuyên mục</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($relateds as $related)
                                <li>
                                    <a href="" title="" class="thumb">
                                        <img src="{{ asset($related->thumbnail) }}">
                                    </a>
                                    <a href="" title="" class="product-name">{{ $related->product_name }}</a>
                                    <div class="price">
                                        <span class="new">{{ number_format($related->price, 0, ',', '.') }}đ</span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="sidebar fl-left">
                <div class="section" id="category-product-wp">

                    @include('components.main_menu')
                </div>
                <div class="section" id="banner-wp">
                    <div class="section-detail">
                        <a href="" title="" class="thumb">
                            <img src="{{ url('public/site') }}/images/banner.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
