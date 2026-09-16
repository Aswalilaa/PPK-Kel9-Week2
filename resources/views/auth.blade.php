<!DOCTYPE html>
<html>
<head>
    <title>Register/Login</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f4f4f4; }
        .box { background: white; padding: 20px; margin-bottom: 20px; border-radius: 8px; max-width: 400px; }
        input, select, button { display: block; width: 100%; margin-bottom: 10px; padding: 8px; box-sizing: border-box; }
        button { background: #28a745; color: white; border: none; cursor: pointer; }
        .danger { background: #dc3545; }
    </style>
</head>
<body>

    <h2>Login/Register</h2>

    <!-- Form Register -->
    <div class="box">
        <h3>1. Register User Biasa</h3>
        <form action="/register" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password (min 8 karakter)" required>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
            <button type="submit">Daftar</button>
        </form>
    </div>

    <!-- Form Login -->
    <div class="box">
        <h3>2. Login</h3>
        <form action="/login" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>

    <!-- Form Logout -->
    <div class="box">
        <h3>3. Logout</h3>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="danger">Logout</button>
        </form>
    </div>

</body>
</html>