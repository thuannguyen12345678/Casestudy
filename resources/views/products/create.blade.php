@extends('admin.layouts.index')

@section('title', 'Thêm mới công viêc')
@include('Slugs.slug');
@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Thêm mới sản phẩm</h2>
        </div>

        <div class="col-md-12">
            <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    {{-- <input type="text" class="form-control" name="name" required> --}}
                    <input type="text" class="form-control" value="{{ old('name') }}" onkeyup="ChangeToSlug();"
                        name="name" id="slug" aria-describedby="emailHelp" placeholder="Tên Sản Phẩm">
                </div>

                <div class="form-group">
                    <label>Gía</label>
                    <textarea class="form-control" rows="3" name="price" required></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1">Ảnh</label>
                    <input type="file" name="image" class="form-control-file" required>
                </div>
                <div class="form-group">
                    <label>slug</label>
                    {{-- <input class="form-control" rows="3" name="slug" required> --}}
                    <input type="text" class="form-control" value="{{ old('slug') }}" name="slug" id="convert_slug"
                        aria-describedby="emailHelp" placeholder="Slug sản phẩm">
                </div>
                {{-- <div class="form-group">
                    <label for="exampleFormControlFile1">danh mục sản phẩm</label>
                    <input type="file" name="danhmuc_id" class="form-control-file" required>
                </div> --}}
                <div class="mb-3">
                    <label for="exampleInputEmail1">danh mục sản phẩm</label>
                    <select name="danhmuc_id" class="form-select" id="inputGroupSelect02">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->LOAIGIAY }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Mô Tả</label>
                    <input class="form-control" rows="3" name="description" required>
                </div>
                <div class="form-group">
                    <label>Trang thái</label>
                    <select name="status">
                        <option value="1">kích hoạt</option>
                        <option value="2">không kích hoạt</option>

                    </select>

                </div>


                {{-- <div class="form-group">
                    <label for="exampleFormControlFile1">Ngày hết hạn</label>
                    <input type="date" name="due_date" class="form-control" required>
                </div> --}}
                <button type="submit" class="btn btn-primary">Thêm mới</button>
                <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Hủy</button>
            </form>
        </div>
    </div>
@endsection
