@extends('layouts.site')
@section('content')
    <div class="container" style="margin-left: 100px; margin-right:100px">
        @foreach ($pages as $page)
            <span style="  font-size: 15pt; ">{{ $page->page_title }}</span>

            <span>{!! $page->page_content !!}</span>
        @endforeach
    </div>
@endsection
