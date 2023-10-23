@foreach ($cat->catagoryChildrent as $catchild)
    <li>

        <a href="{{ route('catalog_product', $catchild->cat_slug) }}" title="">{{ $catchild->catalog_name }}</a>

        @if ($catchild->catagoryChildrent->count())
            <ul class="sub-menu">
                @include('components.child_menu', ['cat' => $catchild])
            </ul>
        @endif

    </li>
@endforeach
