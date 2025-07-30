@include('web.header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - YourApp</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #e0e2f1;
            margin: 0;
        }

        .login-container {
            display: flex;
            min-height: 100vh;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 900px;
            margin: 3rem auto;
            border-radius: 10px;
            overflow: hidden;
            background-color: #fff;
        }

        .login-left {
            flex: 1;
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1f1f1f;
            margin-bottom: 0.25rem;
        }

        .form-subtitle {
            font-size: 0.95rem;
            color: #555a75;
            margin-bottom: 1.5rem;
        }

        form {
            max-width: 350px;
            width: 100%;
        }

        label {
            font-weight: 600;
            font-size: 0.9rem;
            display: block;
            margin-bottom: 6px;
            color: #4a4a4a;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.55rem 0.75rem;
            margin-bottom: 1.25rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #6c63ff;
            outline: none;
        }

        .remember-me {
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            color: #555a75;
        }

        .remember-me input {
            margin-right: 8px;
            accent-color: #6c63ff;
            cursor: pointer;
        }

        .forgot-password {
            margin-left: auto;
            font-size: 0.85rem;
            color: #6c63ff;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        button[type="submit"] {
            background-color: #6c63ff;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 0.75rem 0;
            width: 100%;
            font-weight: 700;
            font-size: 1.05rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #594ddf;
        }

        .divider {
            text-align: center;
            margin: 1.5rem 0;
            font-size: 0.9rem;
            color: #9ca3af;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: '';
            height: 1px;
            background-color: #d1d5db;
            position: absolute;
            top: 50%;
            width: 40%;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        .google-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 0.5rem;
            cursor: pointer;
            font-weight: 600;
            color: #444;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .google-btn img {
            height: 20px;
            margin-right: 0.5rem;
        }

        .google-btn:hover {
            background-color: #f3f4f6;
        }

        .register-link {
            margin-top: 1.5rem;
            font-size: 0.9rem;
            color: #555a75;
            text-align: center;
        }

        .register-link a {
            color: #6c63ff;
            font-weight: 700;
            text-decoration: none;
            margin-left: 6px;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .login-right {
            flex: 1;
            background-image: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80');
            background-size: cover;
            background-position: center;
        }

        /* Responsive */

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 100%;
                margin: 1rem;
                box-shadow: none;
                border-radius: 0;
            }

            .login-right {
                height: 250px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-title">Welcome back!</div>
                <div class="form-subtitle">Enter to get unlimited access to data &amp; information.</div>

                <label for="email">Email *</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Enter your mail address" />
                @error('email')
                    <div style="color: red; font-size: 0.85rem;">{{ $message }}</div>
                @enderror

                <label for="password">Password *</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Enter password" />
                @error('password')
                    <div style="color: red; font-size: 0.85rem;">{{ $message }}</div>
                @enderror

                <div class="remember-me">
                    <input id="remember_me" type="checkbox" name="remember" />
                    <label for="remember_me">Remember me</label>
                    <a href="{{ route('password.request') }}" class="forgot-password">Forgot your password?</a>
                </div>

                <button type="submit">Log In</button>

                <div class="divider">Or, Login with</div>

                <a href="{{ route('google.redirect') }}" class="google-btn">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" alt="Google Icon" />
                    Sign up with Google
                </a>

                <div class="register-link">
                    Don't have an account?
                    <a href="{{ route('register') }}">Register here</a>
                </div>
            </form>
        </div>
        <div class="login-right"></div>
    </div>
</body>
</html>



@include('web.footer')
