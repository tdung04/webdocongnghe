<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách người dùng</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script>
        function confirmDeletion(event) {
            event.preventDefault();
            const form = event.target;
            if (confirm('Bạn có chắc chắn muốn xóa người dùng này không?')) {
                form.submit();
            }
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        @include('admin.header')
        <h1>Danh sách người dùng</h1>
        
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Thêm người dùng</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="confirmDeletion(event)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
