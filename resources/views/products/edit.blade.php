@extends('admin.layouts.index')

@section('title', 'Cập nhật công viêc')
@include('Slugs.slug');
@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Cập nhật công việc</h2>
        </div>

        <div class="col-md-12">
            <form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    {{-- <input type="text" class="form-control" name="name" value="{{ $product->name }}" required> --}}
                    <input type="text" class="form-control" value="{{$product->name}}" onkeyup="ChangeToSlug();"
                     name="name" id="slug" aria-describedby="emailHelp" placeholder="Tên sản phẩm">
                </div>

                <div class="form-group">
                    <label>giá</label>
                    <input class="form-control" rows="3" name="price"  required>{{ $product->price }}
                </div>


                <div class="form-group">
                    <label>Ảnh</label>
                    <input type="file" name="image" class="form-control-file" >
                </div>
                
                <div class="form-group">
                    <label>slug</label>
                    <input class="form-control" rows="3" name="slug"  required>{{ $product->slug }}
                    <input type="text" class="form-control" value="{{$product->slug}}" name="slug" id="convert_slug" 
                    aria-describedby="emailHelp" >
                </div>
                <div class="form-group">
                    <label>Mô tả</label>
                    <input class="form-control" rows="3" name="description"  required>{{ $product->description }}
                </div>
                <div class="form-group">
                    <label>Trạng thái</label>
                    <input class="form-control" rows="3" name="status"  required>{{ $product->status }}
                </div>

                

                {{-- <div class="form-group">
                    <label>Ngày hết hạn</label>
                    <input type="date" name="due_date" class="form-control"  value="{{ $task->due_date }}" required>
                </div> --}}
                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Hủy</button>
            </form>
        </div>
    </div>
@endsection