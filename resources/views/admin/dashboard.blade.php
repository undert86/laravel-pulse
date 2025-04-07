<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель | Pulse</title>
    @vite('resources/css/admin.dashboard.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{Vite::asset('resources/css/admin.dashboard.css')}}" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/svg/Union.svg'])
    <link rel="icon" href="{{ Vite::asset('resources/svg/Union.svg') }}" type="image/x-icon">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --danger-color: #f72585;
            --success-color: #4cc9f0;
            --dark-color: #202020;
            --light-color: #f8f9fa;
            --gray-color: #adb5bd;
            --white-color: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --border-radius: 8px;
        }
        header img {
            width: 300px; /* Ширина логотипа */
            height: auto; /* Автоматическая высота для сохранения пропорций */
        }
        img {
            position: absolute;
            right: 2350px;
            width: 140px;
            height: 1000px;
            top: -457px;

        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
            padding-top: 90px;
        }

        /* Header Styles */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 80px;
            background-color: var(--dark-color);
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            z-index: 1000;
        }

        .header-container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            height: 50px;
            width: auto;
        }

        .user-nav {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-info {
            color: var(--white-color);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            left: 90.5%;
        }

        .logout-btn {
            background-color: var(--danger-color);
            color: white;
            padding: 5px 10px;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            margin-left: 2750%;
        }

        .logout-btn:hover {
            background-color: #d3166b;
            transform: translateY(-2px);
        }

        /* Main Content */
        .main-container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background-color: var(--accent-color);
            border-radius: 2px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background-color: var(--white-color);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card.primary {
            border-left: 4px solid var(--primary-color);
        }

        .stat-card.success {
            border-left: 4px solid var(--success-color);
        }

        .stat-card.info {
            border-left: 4px solid var(--accent-color);
        }

        .stat-title {
            font-size: 1rem;
            color: var(--gray-color);
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
        }

        /* Users Table */
        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
        }

        .table-container {
            background-color: var(--white-color);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
        }

        .users-table thead {
            background-color: var(--dark-color);
            color: var(--white-color);
        }

        .users-table th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
        }

        .users-table td {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .users-table tr:last-child td {
            border-bottom: none;
        }

        .users-table tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        .user-type {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .type-student {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .type-teacher {
            background-color: #e8f5e9;
            color: #388e3c;
        }

        .type-admin {
            background-color: #f3e5f5;
            color: #8e24aa;
        }

        /* Action Buttons */
        .action-btns {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background-color: var(--accent-color);
            color: white;
        }

        .btn-edit:hover {
            background-color: #3a7bd5;
        }

        .btn-delete {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-delete:hover {
            background-color: #d3166b;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--gray-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding-top: 70px;
            }

            header {
                height: 70px;
                padding: 0 1rem;
            }

            .logo {
                height: 40px;
            }

            .main-container {
                padding: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .users-table {
                display: block;
                overflow-x: auto;
            }
        }

        @media (max-width: 480px) {
            .user-nav {
                gap: 1rem;
            }

            .logout-btn {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }

            .users-table th,
            .users-table td {
                padding: 0.75rem 0.5rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
<header>
    <div class="header-container">
        @vite(['resources/svg/Pulse_logo.svg'])
        <img src="{{ Vite::asset('resources/svg/Pulse_logo.svg') }}" alt="Logo">
        <div class="user-nav">
            <div class="user-info">
                <span>Администратор</span>
            </div>
            <a href="{{route('logout')}}" class="logout-btn">Выйти</a>
        </div>
    </div>
</header>

<main class="main-container">
    <h1 class="page-title">Панель администратора</h1>

    <div class="stats-grid">
        <div class="stat-card primary">
            <div class="stat-title">Всего пользователей</div>
            <div class="stat-value">{{ $stats['total_users'] }}</div>
        </div>
        <div class="stat-card success">
            <div class="stat-title">Преподаватели</div>
            <div class="stat-value">{{ $stats['teachers_count'] }}</div>
        </div>
        <div class="stat-card info">
            <div class="stat-title">Студенты</div>
            <div class="stat-value">{{ $stats['students_count'] }}</div>
        </div>
    </div>

    <h2 class="section-title">Список пользователей</h2>

    <div class="table-container">
        @if($users->count() > 0)
            <table class="users-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>ФИО</th>
                    <th>Тип</th>
                    <th>Логин</th>
                    <th>Телефон</th>
                    <th>Группа</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->ID }}</td>
                        <td>{{ $user->LASTNAME }} {{ $user->FIRSTNAME }} {{ $user->MIDDLENAME }}</td>
                        <td>
                                <span class="user-type
                                    @switch($user->type)
                                        @case(0) type-student @break
                                        @case(1) type-teacher @break
                                        @case(2) type-admin @break
                                    @endswitch">
                                    @switch($user->type)
                                        @case(0) Студент @break
                                        @case(1) Преподаватель @break
                                        @case(2) Администратор @break
                                    @endswitch
                                </span>
                        </td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->phone ?: '—' }}</td>
                        <td>{{ $user->group_name ?: '—' }}</td>
                        <td>
                            <div class="action-btns">
                                <a href="#" class="btn btn-edit">Редактировать</a>
                                <a href="#" class="btn btn-delete">Удалить</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                Пользователи не найдены
            </div>
        @endif
    </div>
</main>
</body>
</html>
