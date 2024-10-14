<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Thông tin cá nhân</h1>
        <p>Tên: {{ Auth::user()->name }}</p>
        <p>Email: {{ Auth::user()->email }}</p>
        
        <!-- Hiển thị thông báo lỗi nếu có -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        <a href="/" class="btn btn-primary">Trang chủ</a>
    </div>
</body>
</html>