<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h2>Đăng nhập</h2>

{{-- Hiển thị thông báo lỗi --}}
@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Form đăng nhập --}}
<form method="POST" action="{{ route('login.post') }}">
    @csrf

    <label>Email:</label><br>
    <input type="email" name="email" value="{{ old('email') }}" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<p>Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a></p>
</body>
</html>
