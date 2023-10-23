@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-header font-weight-bold">
                        Danh mục sản phẩm
                    </div>

                    <div class="card-body">
                        <form action="{{ route('catalog.update', $cat->catalog_id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên danh mục</label>
                                <input class="form-control" type="text" name="catalog_name" id="name"
                                    value="{{ $cat->catalog_name }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Danh mục cha</label>
                                <select class="form-control" name="parent_id" id="">
                                    <option value="0">Danh mục cha</option>
                                    @foreach ($catalogs as $item)
                                        <option value="{{ $item['catalog_id'] }}"
                                            {{ $cat->parent_id == $item['catalog_id'] ? 'selected' : '' }}>
                                            {{ str_repeat('---', $item['level']) . $item['catalog_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_idd')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status"
                                        value="0" {{ $cat->status == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Chờ duyệt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status"
                                        value="1" {{ $cat->status == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="exampleRadios2">
                                        Công khai
                                    </label>
                                </div>
                            </div>



                            <button type="submit" name="btn-update" value="them moi" class="btn btn-primary">Cập
                                nhật</button>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh sách
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>

                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Thứ tự</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $t = 0;
                                @endphp
                                @foreach ($catalogs as $cat)
                                    @php
                                        $t++;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $t }}</th>
                                        <td>{{ str_repeat('---', $cat['level']) . $cat['catalog_name'] }}</td>
                                        <td>{{ $cat->parent_id }}</td>
                                        <td>{{ $cat->status == '1' ? 'Công khai' : 'Chờ duyệt' }}</td>
                                        <td>

                                            <a href="{{ route('edit.catalog', $cat->catalog_id) }}"
                                                class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                    class="fa fa-edit"></i></a>



                                            <a href="{{ route('delete.catalog', $cat->catalog_id) }}"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này?')"
                                                class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                    class="fa fa-trash"></i></a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $cats->links() }} --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
