@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">

            <div class="card-header font-weight-bold">
                Cập nhật thông tin sản phẩm
            </div>
            <div class="row">
                <div class="card-body col-2">
                    <p>Ảnh chi tiết</p>
                    @foreach ($images as $img)
                        <form action="{{ route('deleteimage.product', $img->id) }}" method="post">
                            @csrf
                            <button class="btn text-danger">X</button>
                            @method('delete')
                        </form>
                        <img src=" {{ asset($img->image) }} " alt="" class="img-responsive"
                            style="max-height: 150px; max-width:150px; ">
                    @endforeach
                </div>
                <div class="card-body col-10">
                    <form action="{{ route('product.update', $products->product_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf



                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input class="form-control" type="text" name="product_name" id="name"
                                value="{{ $products->product_name }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Giá</label>
                            <input class="form-control" type="text" name="price" id="name"
                                value="{{ $products->price }}">


                            <div class="form-group">
                                <label for="intro">Mô tả sản phẩm</label>
                                <textarea name="desc" class="form-control my-editor" id="intro" cols="30" rows="5">{{ $products->desc }}</textarea>
                            </div>


                            <div class="form-group">
                                <label for="intro">Chi tiết sản phẩm</label>
                                <textarea name="product_datail" class="form-control my-editor" id="intro">{{ $products->product_datail }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="intro">Số lượng sản phẩm</label>
                                <input name="stock_quantity" class="form-control " id="myeditorinstance"
                                    value="{{ $products->stock_quantity }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Ảnh sản phẩm</label>
                                <input class="form-control" type="file" name="thumbnail" id="name"
                                    value="{{ $products->thumbnail }}">
                            </div>

                            <div class="form-group">
                                <label for="name">Ảnh chi tiết sản phẩm</label>
                                <input class="form-control" type="file" name="images[]" id="name" multiple>


                            </div>

                            <div class="form-group">
                                <label for="">Danh mục</label>
                                <select class="form-control" id="" name="cat_id">

                                    @foreach ($cats as $cat)
                                        <option value="{{ $cat->catalog_id }}"
                                            {{ $products->cat_id == $cat->catalog_id ? 'selected' : '' }}>
                                            {{ $cat->catalog_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Sản phẩm nổi bật</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_featured" id="exampleRadios1"
                                        value="1"{{ $products->is_featured == '1' ? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios1"
                                        value="0" {{ $products->status == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Công khai
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios2"
                                        value="1" {{ $products->status == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exampleRadios2">
                                        Chờ duyệt
                                    </label>
                                </div>
                            </div>
                            <button type="submit" name="add_product" value="update" class="btn btn-primary">Cập
                                nhật</button>
                    </form>
                </div>
            </div>

        </div>
    @endsection
