<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Sản Phẩm</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="container">
        <h1>Chỉnh Sửa Sản Phẩm</h1>
        @include('admin.header')

        <!-- Hiển thị thông báo lỗi nếu có -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
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
            @method('PUT')
            <div class="form-group">
                <label for="name">Tên sản phẩm</label>
                <input type="text" name="name" id="name" value="{{ $product->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea name="description" id="description" required>{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="detail">Mô tả chi tiết</label>
                <textarea name="detail" id="detail" required>{{ $product->detail }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Giá</label>
                <input type="text" name="price" id="price" value="{{ $product->price }}" required>
            </div>
            <div class="form-group">
                <label for="quantity">Số lượng</label>
                <input type="text" name="quantity" id="quantity" value="{{ $product->quantity }}" required>
            </div>
            <div class="form-group">
                <label for="image">Hình ảnh hiện tại</label><br>
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                @else
                    Không có hình ảnh
                @endif
                <br><br>
                <label for="image">Tải lên hình ảnh mới</label>
                <input type="file" name="image" id="image">
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
        </form>
    </div>
</body>
</html>
