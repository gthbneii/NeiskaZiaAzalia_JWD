<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Portal Sertifikasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .register-card {
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 420px;
        }

        .register-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .register-header h2 {
            color: #2c3e50;
            font-size: 1.6rem;
            font-weight: 700;
        }

        .register-header p {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #333;
        }

        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-wrapper input {
            width: 100%;
            padding: 10px 40px 10px 14px;
            border: 1px solid #dcdde1;
            border-radius: 6px;
            font-size: 0.95rem;
            outline: none;
            transition: border 0.3s;
        }

        .password-wrapper input:focus {
            border-color: #36C5D8;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            cursor: pointer;
            color: #888;
            font-size: 0.95rem;
        }

        .toggle-password:hover {
            color: #36C5D8;
        }

        .form-group input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #dcdde1;
            border-radius: 6px;
            font-size: 0.95rem;
            outline: none;
            transition: border 0.3s;
        }

        .form-group input:focus {
            border-color: #36C5D8;
        }

        .terms-group {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 20px;
            font-size: 0.85rem;
            color: #555;
        }

        .terms-group input {
            margin-top: 3px;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #36C5D8;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background-color: #2baab9;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.75rem;
            margin-top: 4px;
            display: block;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 0.85rem;
            color: #666;
        }

        .login-link a {
            color: #36C5D8;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="register-card">
        <div class="register-header">
            <h2>Daftar Akun Baru</h2>
            <p>Lengkapi data diri untuk mengakses portal</p>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama Anda"
                    autocomplete="off">
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com"
                    autocomplete="new-email">
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" required placeholder="••••••••"
                        autocomplete="new-password">
                    <i class="fa-solid fa-eye toggle-password" onclick="togglePasswordVisibility('password', this)"></i>
                </div>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        placeholder="••••••••" autocomplete="new-password">
                    <i class="fa-solid fa-eye toggle-password"
                        onclick="togglePasswordVisibility('password_confirmation', this)"></i>
                </div>
            </div>

            <div class="terms-group">
                <input type="checkbox" name="terms" id="terms" required>
                <label for="terms">
                    Saya menyetujui <a href="#"
                        style="color: #36C5D8; text-decoration: none; font-weight: 600;">Syarat & Ketentuan</a> serta
                    Kebijakan Privasi.
                </label>
            </div>
            @error('terms')
                <span class="error-message" style="margin-top: -15px; margin-bottom: 15px;">{{ $message }}</span>
            @enderror

            <button type="submit" class="btn-submit">Daftar Sekarang</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>

</body>

</html>
