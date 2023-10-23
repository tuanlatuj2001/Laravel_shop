@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm bài viết
            </div>
            <div class="card-body">
                <form action="{{ url('admin/post/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tiêu đề bài viết</label>
                        <input class="form-control" type="text" name="post_title" id="name">
                        @error('post_title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Mô tả bài viết</label>
                        <textarea name=" post_excerpt" class="form-control" id="content" cols="30" rows="3"></textarea>
                        @error('post_excerpt')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Nội dung bài viết</label>
                        <textarea name="post_content" class="form-control my-editor" id="myeditorinstance" cols="30" rows="5"></textarea>
                        @error('post_content')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">

                        <label for="name">Ảnh sản phẩm</label>
                        <input class="form-control" type="file" name="thumbnail" id="name">
                        {{-- @if (count($errors) > 0)
                            <div class="text-danger">{{ $errors->first() }}</div>
                        @endif --}}
                        @error('thumbnail')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select class="form-control" id="" name="catalog_posts_id">
                            <option value="">Chọn danh mục</option>
                            @foreach ($cats as $cat)
                                <option value="{{ $cat->catalog_post_id }}">{{ $cat->catalog_post_name }}</option>
                            @endforeach
                        </select>
                        @error('catalog_posts_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="0"
                                checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Chờ duyệt
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios2"
                                value="1">
                            <label class="form-check-label" for="exampleRadios2">
                                Công khai
                            </label>
                        </div>
                    </div>
                    <button type="submit" value="add-post" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
@endsection
