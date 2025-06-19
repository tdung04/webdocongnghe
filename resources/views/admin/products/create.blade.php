<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm Mới</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="container">
        <h2>Thêm Sản Phẩm Mới</h2>
        @include('admin.header')

        <!-- Hiển thị thông báo lỗi -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Hiển thị thông báo lỗi chung -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="category">Loại sản phẩm</label>
                <select name="category" id="category" required>
                    <option value="">Chọn loại sản phẩm</option>
                    <option value="PC" {{ old('category') == 'PC' ? 'selected' : '' }}>PC</option>
                    <option value="Laptop" {{ old('category') == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                    <option value="linhkien" {{ old('category') == 'linhkien' ? 'selected' : '' }}>Linh Kiện</option>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Tên sản phẩm</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea name="description" id="description">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="detail">Mô tả chi tiết</label>
                <textarea name="detail" id="detail">{{ old('detail') }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Giá</label>
                <input type="text" name="price" id="price" value="{{ old('price') }}" required>
            </div>
            <div class="form-group">
                <label for="quantity">Số lượng</label>
                <input type="text" name="quantity" id="quantity" value="{{ old('quantity') }}" required>
            </div>
            <div class="form-group">
                <label for="image">Hình ảnh</label>
                <input type="file" name="image" id="image">
            </div>
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        </form>
    </div>
</body>
</html>
