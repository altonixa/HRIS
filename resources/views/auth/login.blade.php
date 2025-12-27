<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Altonixa HRIS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            background-color: #f8fafc;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            font-family: 'Inter', sans-serif;
        }

        /* Ambient Background */
        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 10% 20%, rgba(147, 51, 234, 0.03) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(16, 185, 129, 0.03) 0%, transparent 40%);
            z-index: 0;
            pointer-events: none;
        }

        .login-card {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 3rem;
            border-radius: 0.75rem; /* rounded-xl */
            width: 100%;
            max-width: 420px;
            z-index: 1;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 10, 0.03), 0 8px 10px -6px rgba(0, 0, 10, 0.03);
        }

        .input-group {
            margin-bottom: 1.5rem;
        }

        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .input-field {
            width: 100%;
            padding: 0.75rem 1rem;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            color: #0f172a;
            font-size: 0.9375rem;
            transition: all 0.2s;
        }

        .input-field:focus {
            outline: none;
            border-color: #9333ea;
            box-shadow: 0 0 0 3px rgba(147, 51, 234, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 0.875rem;
            background: #9333ea;
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-login:hover {
            background: #7e22ce;
            transform: translateY(-1px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .logo-box {
            width: 48px;
            height: 48px;
            background: #9333ea;
            border-radius: 0.75rem;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
    </style>
</head>
<body>

    <div class="login-card animate-fade-in shadow-xl">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <div class="logo-box">
                <i data-lucide="layers" class="w-6 h-6"></i>
            </div>
            <h1 style="font-size: 1.75rem; font-weight: 800; color: #0f172a; margin-bottom: 0.5rem; letter-spacing: -0.025em;">Welcome Back</h1>
            <p style="color: #64748b; font-size: 0.9375rem;">Sign in to your Altonixa workspace</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="input-group">
                <label>Email Address</label>
                <div style="position: relative;">
                    <i data-lucide="mail" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 18px; color: #94a3b8;"></i>
                    <input type="email" name="email" class="input-field" style="padding-left: 2.5rem;" required autofocus placeholder="name@company.com">
                </div>
                @error('email')
                    <span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.375rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label>Password</label>
                <div style="position: relative;">
                    <i data-lucide="lock" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 18px; color: #94a3b8;"></i>
                    <input type="password" name="password" class="input-field" style="padding-left: 2.5rem;" required placeholder="••••••••">
                </div>
                @error('password')
                    <span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.375rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; font-size: 0.875rem;">
                <label style="display: flex; align-items: center; gap: 0.5rem; color: #64748b; cursor: pointer;">
                    <input type="checkbox" name="remember" style="accent-color: #9333ea;"> Remember me
                </label>
                <a href="#" style="color: #9333ea; text-decoration: none; font-weight: 500;">Forgot password?</a>
            </div>

            <button type="submit" class="btn-login">
                Sign In <i data-lucide="arrow-right" style="width: 18px;"></i>
            </button>
        </form>

        <div style="margin-top: 2.5rem; text-align: center; font-size: 0.75rem; color: #94a3b8; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                <i data-lucide="shield-check" class="w-4 h-4"></i>
                Altonixa Security System
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
