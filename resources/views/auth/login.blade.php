<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация | Pulse</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #00f5d4;
            --bg: #0a0a0a;
            --card-bg: #121212;
            --text: #e2e2e2;
            --border: #333333;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background-image:
                radial-gradient(circle at 25% 25%, rgba(0, 245, 212, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(0, 245, 212, 0.05) 0%, transparent 50%);
        }

        .login-card {

            width: 100%;
            max-width: 420px;
            padding: 40px;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 0;
            text-align: center;
            position: relative;
            overflow: hidden;
            margin-top: -10%;
        }

        .login-card::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--primary);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.5s ease;
        }

        .login-card:hover::before {
            transform: scaleX(1);
        }

        .logo {
            height: 50px;
            margin-bottom: 30px;
            filter: brightness(0) invert(1);
        }

        h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            font-weight: 300;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .subtitle {
            color: #888;
            margin-bottom: 30px;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }

        .form-group {
            margin-bottom: 25px;
            text-align: left;
        }

        input {
            font-family: 'Montserrat', sans-serif;
            width: 93%;
            padding: 14px;
            background: transparent;
            border: 1px solid var(--border);
            border-radius: 0;
            color: var(--text);
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 1px var(--primary);
        }

        .btn {
            font-family: 'Montserrat', sans-serif;
            width: 100%;
            padding: 14px;
            background: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
            font-size: 1rem;
            font-weight: 400;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--primary);
            transition: all 0.3s ease;
            z-index: -1;
        }

        .btn:hover {
            color: #121212;
        }

        .btn:hover::before {
            left: 0;
        }

        .error {
            color: #ff4d4d;
            font-size: 0.8rem;
            margin-top: 6px;
            display: block;
        }

        .footer {
            margin-top: 40px;
            color: #555;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }
        img {

        }
    </style>
</head>
<body>
<div class="login-card">
    <img src="{{ Vite::asset('resources/svg/Pulse_logo.svg') }}" alt="Pulse Logo" class="logo">

    <h1>Доступ к системе</h1>
    <p class="subtitle">Введите учетные данные</p>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <input
                type="text"
                id="username"
                name="username"
                placeholder="Логин"
                value="{{ old('username') }}"
                required
            >
            @error('username')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Пароль"
                required
            >
            @error('password')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn">ВОЙТИ</button>
    </form>

    <div class="footer">
        PULSE EDUCATION SECURE ACCESS
    </div>
</div>
</body>
</html>
