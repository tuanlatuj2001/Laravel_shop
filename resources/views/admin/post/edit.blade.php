@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm bài viết
            </div>
            <div class="card-body">
                <form action="{{ route('post.update', $post->post_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tiêu đề bài viết</label>
                        <input class="form-control" type="text" name="post_title" id="name"
                            value="{{ $post->post_title }}">
                        @error('post_title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Mô tả bài viết</label>
                        <textarea name=" post_excerpt" class="form-control" id="content" cols="30" rows="3">{{ $post->post_excerpt }}</textarea>
                        @error('post_excerpt')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Nội dung bài viết</label>
                        <textarea name="post_content" class="form-control my-editor" id="myeditorinstance" cols="30" rows="5">{{ $post->post_content }}</textarea>
                        @error('post_content')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">

                        <label for="name">Ảnh sản phẩm</label>
                        <input class="form-control" type="file" name="thumbnail" id="name"
                            value="{{ $post->thumbnail_post }}">

                        @error('thumbnail')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select class="form-control" id="" name="catalog_posts_id">
                            <option value="">Chọn danh mục</option>
                            @foreach ($cats as $cat)
                                <option value="{{ $cat->catalog_post_id }}"
                                    {{ $post->catalog_posts_id == $cat->catalog_post_id ? 'selected' : '' }}>
                                    {{ $cat->catalog_post_name }}</option>
                            @endforeach
                        </select>
                        @error('catalog_posts_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1"
                                {{ $post->post_status == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleRadios1">
                                Chờ duyệt
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="0"
                                {{ $post->post_status == '0' ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleRadios2">
                                Công khai
                            </label>
                        </div>
                    </div>
                    <button type="submit" value="add-post" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection
