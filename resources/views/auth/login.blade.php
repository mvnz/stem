<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Smart Waste Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- klo sudah ada Bootstrap, boleh tetap dipakai --}}
    <link rel="stylesheet" href="{{ asset('dash/css/css-bootstrap1.min.css') }}">

    <style>
        body {
            min-height: 100vh;
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: radial-gradient(circle at top left, #4f46e5, #0284c7, #0ea5e9);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 24px;
        }

        .auth-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow:
                0 18px 45px rgba(15, 23, 42, 0.25),
                0 0 0 1px rgba(148, 163, 184, 0.15);
            padding: 32px 32px 28px;
            position: relative;
            overflow: hidden;
        }

        .auth-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top right, rgba(59,130,246,0.28), transparent 60%);
            opacity: 0.7;
            pointer-events: none;
        }

        .auth-inner {
            position: relative;
            z-index: 1;
        }

        .auth-logo {
            text-align: center;
            margin-bottom: 24px;
        }

        .auth-logo img {
            width: 120px;
            height: auto;
            margin-bottom: 8px;
        }

        .auth-title {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .auth-subtitle {
            font-size: 13px;
            color: #64748b;
        }

        .auth-label {
            font-size: 13px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .auth-input {
            width: 100%;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 10px 12px;
            font-size: 14px;
            color: #0f172a;
            transition: all .18s ease;
            background-color: #f9fafb;
        }

        .auth-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59,130,246,.25);
            background-color: #ffffff;
        }

        .auth-input::placeholder {
            color: #cbd5f5;
        }

        .auth-group {
            margin-bottom: 14px;
        }

        .auth-button {
            width: 100%;
            border: none;
            border-radius: 999px;
            padding: 10px 16px;
            font-size: 15px;
            font-weight: 600;
            background: linear-gradient(135deg, #2563eb, #0ea5e9);
            color: #ffffff;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            letter-spacing: 0.02em;
            transition: transform .15s ease, box-shadow .15s ease, filter .15s ease;
            box-shadow: 0 12px 22px rgba(37, 99, 235, 0.35);
        }

        .auth-button:hover {
            transform: translateY(-1px);
            filter: brightness(1.04);
            box-shadow: 0 16px 32px rgba(37, 99, 235, 0.4);
        }

        .auth-button:active {
            transform: translateY(0);
            box-shadow: 0 10px 20px rgba(30,64,175,0.4);
        }

        .auth-footer {
            margin-top: 18px;
            font-size: 11px;
            text-align: center;
            color: #94a3b8;
        }

        .auth-footer span {
            font-weight: 600;
            color: #0f172a;
        }

        .auth-alert {
            font-size: 13px;
            border-radius: 10px;
            padding: 8px 10px;
            margin-bottom: 10px;
        }

        .auth-alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }

        .auth-alert-success {
            background: #ecfdf5;
            border: 1px solid #bbf7d0;
            color: #15803d;
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 24px 20px 20px;
            }
        }
        .auth-logo img {
    width: 80%;
    max-width: 85%;
    height: auto;
}
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-inner">
                <div class="auth-logo">
                    <img src="{{ asset('dash/images/wms-login.png') }}" alt="Smart Waste Logo" >
                </div>

                {{-- pesan sukses / error --}}
                @if (session('success'))
                    <div class="auth-alert auth-alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="auth-alert auth-alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <div class="auth-group">
                        <label class="auth-label" for="username">Username</label>
                        <input
                            id="username"
                            type="text"
                            name="username"
                            class="auth-input"
                            placeholder="Masukkan username"
                            value="{{ old('username') }}"
                            required
                            autofocus>
                    </div>

                    <div class="auth-group" style="margin-bottom: 18px;">
                        <label class="auth-label" for="password">Password</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="auth-input"
                            placeholder="Masukkan password"
                            required>
                    </div>

                    <button type="submit" class="auth-button">
                        Login
                    </button>
                </form>

                <div class="auth-footer">
                    © {{ now()->year }} <span>Smart Waste</span> · Kelompok 6 AKPSI
                </div>
            </div>
        </div>
    </div>
</body>
</html>
