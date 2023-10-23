<!DOCTYPE html>
<html>

<head>
    <title>ISMART STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ url('public/site') }}/css/bootstrap/bootstrap-theme.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/site') }}/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/site') }}/reset.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/site') }}/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/site') }}/css/carousel/owl.theme.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/site') }}/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/site') }}/responsive.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/site') }}/css/import/home.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/site') }}/css/import/header.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/site') }}/css/import/global.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/site') }}/css/import/fonts.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/site') }}/css/import/footer.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/site') }}/css/import/category_product.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/site') }}/css/import/blog.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/site') }}/css/import/detail_product.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/site') }}/css/import/detail_blog.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/site') }}/css/import/cart.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/site') }}/css/import/checkout.css" rel="stylesheet" type="text/css" />

    <script src="{{ url('public/site') }}/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="{{ url('public/site') }}/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
    <script src="{{ url('public/site') }}/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ url('public/site') }}/js/carousel/owl.carousel.js" type="text/javascript"></script>
    <script src="{{ url('public/site') }}/js/main.js" type="text/javascript"></script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="/shop2t" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="?page=category_product" title="">Sản phẩm</a>
                                </li>
                                <li>
                                    <a href="{{ route('post') }}" title="">Blog</a>
                                </li>
                                <li>
                                    <a href="?page=detail_blog" title="">Liên hệ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="/shop2t" title="" id="logo" class="fl-left"><img
                                src="{{ url('public/site') }}/images/logo.png" /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="POST" action="">
                                <input type="text" name="s" id="s"
                                    placeholder="Nhập từ khóa tìm kiếm tại đây!">
                                <button type="submit" id="sm-s">Tìm kiếm</button>
                            </form>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0987.654.321</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i>
                            </div>
                            <a href="" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">2</span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <a href="{{ route('cart') }}" style="color: white;"> <i
                                            class="fa fa-shopping-cart" aria-hidden="true"></i> </a>

                                    <span id="num">{{ Cart::count() }}</span>
                                </div>
                                <div id="dropdown">
                                    <p class="desc">Có <span>{{ Cart::count() }} sản phẩm</span> trong giỏ hàng</p>
                                    <ul class="list-cart">
                                        @foreach (Cart::content() as $row)
                                            <li class="clearfix">
                                                <a href="" title="" class="thumb fl-left">
                                                    <img src="{{ asset($row->options->thumbnail) }}" alt="">
                                                </a>
                                                <div class="info fl-right">
                                                    <a href="" title=""
                                                        class="product-name">{{ $row->name }}</a>
                                                    <p class="price">{{ number_format($row->price, 0, ',', '.') }}đ
                                                    </p>
                                                    <p class="qty">Số lượng: <span>{{ $row->qty }}</span></p>
                                                </div>
                                            </li>
                                        @endforeach

                                    </ul>
                                    <div class="total-price clearfix">
                                        <p class="title fl-left">Tổng:</p> {{ Cart::total() }}đ
                                        <p class="price fl-right">
                                            <dic class="action-cart clearfix">
                                                <a href="{{ route('cart') }}" title="Giỏ hàng"
                                                    class="view-cart fl-left">Giỏ
                                                    hàng</a>
                                                <a href="?page=checkout" title="Thanh toán"
                                                    class="checkout fl-right">Thanh
                                                    toán</a>
                                            </dic>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="main-content-wp" class="home-page clearfix">
                    @yield('content')
                </div>
                <div id="footer-wp">
                    <div id="foot-body">
                        <div class="wp-inner clearfix">
                            <div class="block" id="info-company">
                                <h3 class="title">ISMART</h3>
                                <p class="desc">ISMART luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ
                                    ràng,
                                    chính sách ưu
                                    đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                                <div id="payment">
                                    <div class="thumb">
                                        <img src="public/images/img-foot.png" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="block menu-ft" id="info-shop">
                                <h3 class="title">Thông tin cửa hàng</h3>
                                <ul class="list-item">
                                    <li>
                                        <p>106 - Trần Bình - Cầu Giấy - Hà Nội</p>
                                    </li>
                                    <li>
                                        <p>0987.654.321 - 0989.989.989</p>
                                    </li>
                                    <li>
                                        <p>vshop@gmail.com</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="block menu-ft policy" id="info-shop">
                                <h3 class="title">Chính sách mua hàng</h3>
                                <ul class="list-item">
                                    {{-- @foreach ($pages as $p)
                                    <li>
                                        <a href="{{ route('page_gt', $p->page_slug) }}"
                                            title="">{{ $p->page_title }}</a>
                                    </li>
                                @endforeach --}}

                                </ul>
                            </div>
                            <div class="block" id="newfeed">
                                <h3 class="title">Bảng tin</h3>
                                <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                                <div id="form-reg">
                                    <form method="POST" action="">
                                        <input type="email" name="email" id="email"
                                            placeholder="Nhập email tại đây">
                                        <button type="submit" id="sm-reg">Đăng ký</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="foot-bot">
                        <div class="wp-inner">
                            <p id="copyright">© Bản quyền thuộc về shop2T </p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu-respon">
                <a href="?page=home" title="" class="logo">VSHOP</a>
                <div id="menu-respon-wp">
                    <ul class="" id="main-menu-respon">
                        <li>
                            <a href="?page=home" title>Trang chủ</a>
                        </li>
                        <li>
                            <a href="?page=category_product" title>Điện thoại</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?page=category_product" title="">Iphone</a>
                                </li>
                                <li>
                                    <a href="?page=category_product" title="">Samsung</a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="?page=category_product" title="">Iphone X</a>
                                        </li>
                                        <li>
                                            <a href="?page=category_product" title="">Iphone 8</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="?page=category_product" title="">Nokia</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?page=category_product" title>Máy tính bảng</a>
                        </li>
                        <li>
                            <a href="?page=category_product" title>Laptop</a>
                        </li>
                        <li>
                            <a href="?page=category_product" title>Đồ dùng sinh hoạt</a>
                        </li>
                        <li>
                            <a href="?page=blog" title>Blog</a>
                        </li>
                        <li>
                            <a href="#" title>Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="btn-top"><img src="public/images/icon-to-top.png" alt="" /></div>
            <div id="fb-root"></div>
            <script>
                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id))
                        return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            </script>
</body>

</html>
