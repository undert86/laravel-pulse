<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доступ запрещен (403)</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --dark-bg: #121212;
            --darker-bg: #0a0a0a;
            --card-bg: #1e1e1e;
            --primary: #79D0C2;
            --primary-hover: #5cb3a7;
            --text: #e0e0e0;
            --text-muted: #9e9e9e;
            --error: #ff4d4d;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--dark-bg);
            color: var(--text);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin: 0;
            padding: 20px;
            background-image:
                radial-gradient(circle at 25% 25%, rgba(121, 208, 194, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(121, 208, 194, 0.1) 0%, transparent 50%);
        }

        .error-container {
            max-width: 600px;
            width: 100%;
            padding: 3rem;
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.05);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .error-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(121, 208, 194, 0.05) 0%, transparent 70%);
            z-index: -1;
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .error-code {
            font-size: 5rem;
            font-weight: 700;
            color: var(--error);
            margin-bottom: 1.5rem;
            text-shadow: 0 0 15px rgba(255, 77, 77, 0.3);
        }

        .error-title {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            color: var(--text);
        }

        .error-message {
            font-size: 1.1rem;
            margin-bottom: 2.5rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .error-icon {
            font-size: 4rem;
            color: var(--error);
            margin-bottom: 2rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .btn-home {
            background-color: var(--primary);
            color: #121212;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            display: inline-block;
            margin: 0.5rem;
            box-shadow: 0 4px 15px rgba(121, 208, 194, 0.3);
        }

        .btn-home:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(121, 208, 194, 0.4);
            color: #121212;
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            margin: 0.5rem;
        }

        .btn-outline:hover {
            background-color: rgba(121, 208, 194, 0.1);
            color: var(--primary);
        }

        .admin-link {
            margin-top: 2rem;
            font-size: 0.9rem;
        }

        .admin-link a {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.3s;
        }

        .admin-link a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        /* Адаптивность */
        @media (max-width: 768px) {
            .error-container {
                padding: 2rem 1.5rem;
            }

            .error-code {
                font-size: 4rem;
            }

            .error-title {
                font-size: 1.5rem;
            }

            .btn-home, .btn-outline {
                padding: 0.6rem 1.5rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
<div class="error-container">
    <div class="error-icon">
        <i class="fas fa-lock"></i>
    </div>

    <div class="error-code">403</div>
    <h1 class="error-title">Доступ запрещен</h1>
    <p class="error-message">
        У вас недостаточно прав для просмотра этой страницы.

    </p>

    <div class="d-flex flex-wrap justify-content-center">
        <a href="{{ url('/') }}" class="btn-home">
            <i class="fas fa-home me-2"></i> На главную
        </a>

    </div>

    @if(auth()->check() && auth()->user()->isAdmin())
        <div class="admin-link mt-4">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fas fa-lock-open me-1"></i> Перейти в панель администратора
            </a>
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
