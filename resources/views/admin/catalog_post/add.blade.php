<div class="card-body">
    <form action="{{ url('admin/catalog_post/store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên danh mục</label>
            <input class="form-control" type="text" name=" catalog_post_name" id="name">
            @error('catalog_post_name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Danh mục cha</label>
            <select class="form-control" name="parent_id" id="">
                <option value="">Chọn danh mục</option>
                <option value="0">Danh mục cha</option>
                @foreach ($catalog_posts as $item)
                    <option value="{{ $item['catalog_post_id'] }}">
                        {{ str_repeat('---', $item['level']) . $item['catalog_post_name'] }}
                    </option>
                @endforeach
            </select>

            @error('parent_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Trạng thái</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status" value="0" checked>
                <label class="form-check-label" for="exampleRadios1">
                    Chờ duyệt
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="status" value="1">
                <label class="form-check-label" for="exampleRadios2">
                    Công khai
                </label>
            </div>
        </div>



        <button type="submit" name="btn-add" value="them moi" class="btn btn-primary">Thêm mới</button>
    </form>
</div>
