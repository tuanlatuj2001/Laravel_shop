@extends('layouts.site')
@section('content')
    <div id="main-content-wp" class="clearfix blog-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="/shop2t" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="/bai-viet" title="">Blog</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="list-blog-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title">Blog</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($posts as $post)
                                <li class="clearfix">
                                    <a href="{{ route('detail_post', $post->post_slug) }}" title=""
                                        class="thumb fl-left">
                                        <img src="{{ asset($post->thumbnail_post) }}" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="{{ route('detail_post', $post->post_slug) }}" title=""
                                            class="title">{{ $post->post_title }}</a>
                                        <span class="create-date">{{ $post->created_at }}</span>
                                        <p class="desc">{{ $post->post_excerpt }} [...]</p>
                                    </div>
                                </li>
                            @endforeach
                            {{ $posts->links() }}
                        </ul>
                    </div>
                </div>

            </div>
            <div class="sidebar fl-left">
                <div class="section" id="selling-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm bán chạy</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            <li class="clearfix">
                                <a href="?page=detail_product" title="" class="thumb fl-left">
                                    <img src="public/images/img-pro-13.png" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="?page=detail_product" title="" class="product-name">Laptop Asus A540UP
                                        I5</a>
                                    <div class="price">
                                        <span class="new">5.190.000đ</span>
                                        <span class="old">7.190.000đ</span>
                                    </div>
                                    <a href="" title="" class="buy-now">Mua ngay</a>
                                </div>
                            </li>
                            <li class="clearfix">
                                <a href="?page=detail_product" title="" class="thumb fl-left">
                                    <img src="public/images/img-pro-11.png" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                    <div class="price">
                                        <span class="new">15.190.000đ</span>
                                        <span class="old">17.190.000đ</span>
                                    </div>
                                    <a href="" title="" class="buy-now">Mua ngay</a>
                                </div>
                            </li>
                            <li class="clearfix">
                                <a href="?page=detail_product" title="" class="thumb fl-left">
                                    <img src="public/images/img-pro-12.png" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                    <div class="price">
                                        <span class="new">15.190.000đ</span>
                                        <span class="old">17.190.000đ</span>
                                    </div>
                                    <a href="" title="" class="buy-now">Mua ngay</a>
                                </div>
                            </li>
                            <li class="clearfix">
                                <a href="?page=detail_product" title="" class="thumb fl-left">
                                    <img src="public/images/img-pro-05.png" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                    <div class="price">
                                        <span class="new">15.190.000đ</span>
                                        <span class="old">17.190.000đ</span>
                                    </div>
                                    <a href="" title="" class="buy-now">Mua ngay</a>
                                </div>
                            </li>
                            <li class="clearfix">
                                <a href="?page=detail_product" title="" class="thumb fl-left">
                                    <img src="public/images/img-pro-22.png" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                    <div class="price">
                                        <span class="new">15.190.000đ</span>
                                        <span class="old">17.190.000đ</span>
                                    </div>
                                    <a href="" title="" class="buy-now">Mua ngay</a>
                                </div>
                            </li>
                            <li class="clearfix">
                                <a href="?page=detail_product" title="" class="thumb fl-left">
                                    <img src="public/images/img-pro-23.png" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                    <div class="price">
                                        <span class="new">15.190.000đ</span>
                                        <span class="old">17.190.000đ</span>
                                    </div>
                                    <a href="" title="" class="buy-now">Mua ngay</a>
                                </div>
                            </li>
                            <li class="clearfix">
                                <a href="?page=detail_product" title="" class="thumb fl-left">
                                    <img src="public/images/img-pro-18.png" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                    <div class="price">
                                        <span class="new">15.190.000đ</span>
                                        <span class="old">17.190.000đ</span>
                                    </div>
                                    <a href="" title="" class="buy-now">Mua ngay</a>
                                </div>
                            </li>
                            <li class="clearfix">
                                <a href="?page=detail_product" title="" class="thumb fl-left">
                                    <img src="public/images/img-pro-15.png" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="?page=detail_product" title="" class="product-name">Iphone X Plus</a>
                                    <div class="price">
                                        <span class="new">15.190.000đ</span>
                                        <span class="old">17.190.000đ</span>
                                    </div>
                                    <a href="" title="" class="buy-now">Mua ngay</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="section" id="banner-wp">
                    <div class="section-detail">
                        <a href="?page=detail_blog_product" title="" class="thumb">
                            <img src="public/images/banner.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
