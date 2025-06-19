<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống Kê Bán Hàng</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <style>
        /* Styles for the Statistics Tables */
.stats-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #ffffff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.stats-table th, .stats-table td {
    border: 1px solid #ddd;
    padding: 8px 16px;
    text-align: left;
}

.stats-table th {
    background-color: #f4f4f4;
    color: #333;
}

.stats-table td {
    color: #555;
}

/* Enhancing table headers */
.stats-table th {
    font-size: 16px;
    letter-spacing: 0.5px;
}

/* Enhancing table data */
.stats-table td {
    font-size: 14px;
}

/* Styling for the headings */
h3 {
    color: #333;
    padding-bottom: 8px;
    border-bottom: 2px solid #eee;
    margin-top: 30px;
    margin-bottom: 10px;
}

/* General container and spacing */
.container {
    padding: 20px;
    background-color: #fafafa;
    border-radius: 8px;
    margin-top: 20px;
}

    </style>
    <div class="container">
        @include('admin.header')

        <h2>Thống Kê Bán Hàng</h2>

        <h3>Doanh Thu</h3>
        <table class="stats-table">
        <form action="{{ route('admin.statistics') }}" method="GET" class="month-selector">
    <div class="form-group">
        <label for="month">Chọn Tháng:</label>
        <select name="month" id="month" onchange="this.form.submit()">
            <option value="">--Chọn Tháng--</option>
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                    Tháng {{ $i }}
                </option>
            @endfor
        </select>
    </div>
</form>

            <thead>
                <tr>
                    <th>Doanh Thu Tháng Này</th>
                    <th>Doanh Thu Năm Này</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ number_format($monthlyRevenue, 0, ',', '.') }} VND</td>
                    <td>{{ number_format($yearlyRevenue, 0, ',', '.') }} VND</td>
                </tr>
            </tbody>
        </table>

        <h3>Bán Hàng và Tồn Kho</h3>
        <table class="stats-table">
            <thead>
                <tr>
                    <th>Sản Phẩm</th>
                    <th>Số Lượng Bán Ra</th>
                    <th>Số Lượng Tồn Kho</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salesData as $data)
                    <tr>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->total_sold }}</td>
                        <td>{{ $data->stock_remaining }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
