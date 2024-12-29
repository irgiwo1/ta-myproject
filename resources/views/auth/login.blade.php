<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #1e3a8a; /* Warna biru tua */
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: relative;
            animation: slideUp 0.8s ease-out; /* Animasi muncul dari bawah */
        }
        @keyframes slideUp {
            0% {
                transform: translateY(30px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .login-container h3 {
            color: #333;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .form-control {
            border-radius: 30px;
            padding: 15px;
            font-size: 14px;
            border: 1px solid #ddd;
            box-shadow: none;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 30px;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .register-link {
            color: #007bff;
            font-weight: bold;
            text-decoration: none;
        }
        .register-link:hover {
            text-decoration: underline;
        }
        /* Animasi logo hiu */
        .shark-emoji {
            position: absolute;
            top: -10px;
            right: 10px;
            font-size: 50px;
            animation: sharkSwim 2s infinite;
        }
        @keyframes sharkSwim {
            0% {
                transform: translateX(0);
            }
            50% {
                transform: translateX(10px);
            }
            100% {
                transform: translateX(0);
            }
        }
        /* Logo UNPAM */
        .unpam-logo {
            max-width: 100px;
            margin-bottom: 20px;
        }
        /* Menutup mata saat input */
        .shark-closed {
            font-size: 50px;
            transform: scale(0.8); /* Hiu menutup mata */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-container">
                    <div class="text-center">
                        <!-- Logo UNPAM -->
                        <img src="{{ asset('assets/images/unpam.png') }}" alt="Logo UNPAM" class="unpam-logo">
                        <!-- Emoji Hiu -->
                        <span id="sharkEmoji" class="shark-emoji">😊</span>
                    </div>
                    <h3 class="text-center">Login</h3>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required placeholder="Enter your password">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </div>
                        <p class="text-center">
                            Belum punya akun? <a href="{{ route('register') }}" class="register-link">Register</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk animasi emoji -->
    <script>
        const emailInput = document.getElementById('email');
        const sharkEmoji = document.getElementById('sharkEmoji');
        const isLoggedIn = false; // Ganti dengan status login yang sebenarnya

        // Kondisi untuk menampilkan emoji senyum atau senang berdasarkan status login
        if (isLoggedIn) {
            sharkEmoji.textContent = '😁';  // Emoji Senang setelah login
        } else {
            sharkEmoji.textContent = '😊';  // Emoji Senyum sebelum login
        }

        emailInput.addEventListener('input', function() {
            // Menutup mata emoji saat ada input di username
            if (emailInput.value.length > 0) {
                sharkEmoji.classList.add('shark-closed');
            } else {
                sharkEmoji.classList.remove('shark-closed');
            }
        });
    </script>

    <!-- Bootstrap JS (optional for some interactivity) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
