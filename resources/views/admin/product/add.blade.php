@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm sản phẩm
            </div>
            <div class="card-body col-12">
                <form action="{{ url('admin/product/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input class="form-control" type="text" name="product_name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="name">Giá</label>
                                <input class="form-control" type="text" name="price" id="name">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="intro">Mô tả sản phẩm</label>
                                <textarea name="desc" class="form-control" id="intro" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="intro">Chi tiết sản phẩm</label>
                        <textarea name="product_datail" class="form-control my-editor" id="myeditorinstance" cols="30" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="intro">Số lượng sản phẩm</label>
                        <input name="stock_quantity" class="form-control" id="intro">
                    </div>
                    <div class="form-group">
                        <label for="name">Ảnh sản phẩm</label>
                        <input class="form-control" type="file" name="thumbnail" id="name">
                    </div>
                    <div class="form-group">
                        <label for="name">Ảnh chi tiết sản phẩm</label>
                        <input class="form-control" type="file" name="images[]" id="name" multiple>
                    </div>


                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select class="form-control" id="" name="cat_id">
                            <option value="">Chọn danh mục</option>
                            @foreach ($products as $pr)
                                <option value="{{ $pr->catalog_id }}">{{ $pr->catalog_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Sản phẩm nổi bật</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_featured" id="exampleRadios1"
                                value="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="0"
                                checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Công khai
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="exampleRadios2"
                                value="1">
                            <label class="form-check-label" for="exampleRadios2">
                                chờ duyệt
                            </label>
                        </div>
                    </div>



                    <button type="submit" name="add_product" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>
@endsection
