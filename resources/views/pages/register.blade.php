<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - RoadCare</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .register-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 40px 35px;
            width: 100%;
            max-width: 420px;
        }

        .logo {
            width: 50px;
            height: 50px;
            background-color: #2563eb;
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
            font-size: 24px;
            font-weight: bold;
            color: white;
        }

        .register-card h2 {
            text-align: center;
            color: #1a1a2e;
            font-size: 24px;
            margin-bottom: 8px;
        }

        .register-card .subtitle {
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-group label span {
            font-weight: 400;
            color: #9ca3af;
            font-size: 12px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            color: #374151;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-group input::placeholder {
            color: #9ca3af;
        }

        .form-group input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-group input.error {
            border-color: #ef4444;
        }

        .error-message {
            color: #ef4444;
            font-size: 12px;
            margin-top: 5px;
        }

        .btn-register {
            width: 100%;
            padding: 13px;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.2s;
        }

        .btn-register:hover {
            background-color: #1d4ed8;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #6b7280;
        }

        .login-link a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .password-strength {
            margin-top: 5px;
            font-size: 12px;
            color: #6b7280;
        }

        .terms {
            display: flex;
            align-items: flex-start;
            margin-bottom: 18px;
        }

        .terms input[type="checkbox"] {
            margin-right: 8px;
            margin-top: 3px;
        }

        .terms label {
            font-size: 13px;
            color: #374151;
            font-weight: 400;
        }

        .terms a {
            color: #2563eb;
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="logo">R</div>
        <h2>Daftar RoadCare</h2>
        <p class="subtitle">Buat akun baru Anda</p>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <!-- Nama Lengkap -->
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    placeholder="Masukkan nama lengkap" 
                    value="{{ old('name') }}"
                    required
                >
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="nama@email.com" 
                    value="{{ old('email') }}"
                    required
                >
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    placeholder="Minimal 8 karakter" 
                    required
                >
                <div class="password-strength">Minimal 8 karakter, kombinasi huruf dan angka</div>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    placeholder="Ulangi password" 
                    required
                >
            </div>

            <!-- Terms & Conditions -->
            <div class="terms">
                <input 
                    type="checkbox" 
                    id="terms" 
                    name="terms" 
                    required
                >
                <label for="terms">
                    Saya setuju dengan <a href="#">Syarat & Ketentuan</a> serta <a href="#">Kebijakan Privasi</a> RoadCare
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-register">Daftar Sekarang</button>
        </form>

        <!-- Login Link -->
        <p class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </div>

    <script>
        // Password strength indicator (optional)
        document.getElementById('password').addEventListener('input', function(e) {
            const password = e.target.value;
            const strengthText = document.querySelector('.password-strength');
            
            if (password.length >= 8) {
                strengthText.style.color = '#10b981';
                strengthText.textContent = 'Password kuat ✓';
            } else {
                strengthText.style.color = '#6b7280';
                strengthText.textContent = 'Minimal 8 karakter, kombinasi huruf dan angka';
            }
        });
    </script>
</body>
</html>