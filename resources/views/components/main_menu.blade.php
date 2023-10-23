<div class="section" id="category-product-wp">
    <div class="section-head">
        <h3 class="section-title">Danh mục sản phẩm</h3>
    </div>
    <div class="secion-detail">
        <ul class="list-item">
            @foreach ($catagorys as $cat)
                <li>
                    <a href="{{ route('catalog_product', $cat->cat_slug) }}" title="">{{ $cat->catalog_name }}</a>
                    @if ($cat->catagoryChildrent->count())
                        <ul class="sub-menu">
                            @include('components.child_menu', ['cat' => $cat])
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
