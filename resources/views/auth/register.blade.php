<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
<h2>Đăng ký</h2>
<form method="POST" action="{{ route('register.post') }}">
    @csrf
    <label>Tên:</label>
    <input type="text" name="name" required><br>

    <label>Email:</label>
    <input type="email" name="email" required><br>

    <label>Password:</label>
    <input type="password" name="password" required><br>

    <label>Nhập lại password:</label>
    <input type="password" name="password_confirmation" required><br>

    <button type="submit">Đăng ký</button>
</form>
<p>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
</body>
</html>
