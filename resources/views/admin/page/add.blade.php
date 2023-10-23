@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm trang
            </div>
            <div class="card-body">
                <form action="{{ url('admin/page/store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tiêu đề trang</label>
                        <input class="form-control" type="text" name="page_title" id="name">
                        @error('page_title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Nội dung trang</label>
                        <textarea name="page_content" class="form-control my-editor" id="myeditorinstance" cols="30" rows="5"></textarea>
                        @error('page_content')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

            </div>
            <div class="form-group" style="padding-left: 20px">
                <label for="">Trạng thái</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="page_status" id="exampleRadios1" value="1"
                        checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Chờ duyệt
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="page_status" id="exampleRadios2" value="0">
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
