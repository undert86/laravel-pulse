
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет | Pulse</title>
    @vite('resources/css/dashboard.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ Vite::asset('resources/svg/Union.svg') }}" type="image/x-icon">
    <!-- Добавляем Bootstrap для стилей таблицы и бейджей -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header>
    <div class="header-container">
        <img src="{{ Vite::asset('resources/svg/Pulse_logo.svg') }}" alt="Logo">

        <nav class="nav-links">
            <a href="" class="nav-link">Главная</a>
            <a href="{{route('grades')}}" class="nav-link">Оценки</a>
            <div class="dropdown">
                <a href="#" class="nav-link">Расписание</a>
                <div class="dropdown-menu">
                    <a href="one.php" class="dropdown-item">1 курс</a>
                    <a href="#" class="dropdown-item">2 курс</a>
                    <a href="#" class="dropdown-item">3 курс</a>
                </div>
            </div>
            <a href="#" class="nav-link">Новости</a>
            <a href="#" class="nav-link">О сайте</a>
            <a href="obrasheniya.php" class="nav-link">Есть вопрос?</a>

        </nav>

    </div>
</header>

<main class="main-container">
    <div class="attendance-section">
        <div class="section-header">
            <h2 class="section-title">Посещаемость</h2>
        </div>

        @if(isset($attendances) && $attendances->count())
            <table class="table attendance-table">
                <thead class="table-dark">
                <tr>
                    <th>Дата</th>
                    <th>Предмет</th>
                    <th>Преподаватель</th>
                    <th>Статус</th>
                </tr>
                </thead>
                <tbody>
                @foreach($attendances as $attendance)
                    <tr class="{{ $attendance->status == 'absent' ? 'table-danger' : '' }}">
                        <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d.m.Y') }}</td>
                        <td>{{ $attendance->subject->name ?? 'Не указан' }}</td>
                        <td>
                            @if($attendance->teacher)
                                {{ $attendance->teacher->last_name ?? '' }}
                                {{ $attendance->teacher->first_name ?? '' }}
                            @else
                                Не указан
                            @endif
                        </td>
                        <td>
                            @if($attendance->status == 'present')
                                <span class="badge bg-success">Присутствовал</span>
                            @else
                                <span class="badge bg-danger">Отсутствовал</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Пагинация -->
            <div class="d-flex justify-content-center mt-3">
                {{ $attendances->links() }}
            </div>
        @else
            <div class="alert alert-info">Нет данных о посещаемости</div>
        @endif
    </div>
</main>

<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3 class="footer-title">О нас</h3>
            <p class="footer-text">Мы — современная образовательная платформа, помогающая учителям и студентам взаимодействовать эффективно и удобно.</p>
            <div class="social-links">
                <a href="#" class="social-link">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                    </svg>
                </a>
                <a href="#" class="social-link">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                    </svg>
                </a>
                <a href="#" class="social-link">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                    </svg>
                </a>
            </div>
        </div>
        <div class="footer-section">
            <h3 class="footer-title">Ссылки</h3>
            <ul class="footer-list">
                <li class="footer-item"><a href="teacher.php" class="footer-link">Главная</a></li>
                <li class="footer-item"><a href="teacher_dashboard.php" class="footer-link">Выставление оценок</a></li>
                <li class="footer-item"><a href="added_grades.php" class="footer-link">Выставленные оценки</a></li>
                <li class="footer-item"><a href="obrasheniya.php" class="footer-link">Есть вопрос?</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3 class="footer-title">Контакты</h3>
            <ul class="footer-list">
                <li class="footer-item">
                    <a href="mailto:support@pulse.edu" class="footer-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        support@pulse.edu
                    </a>
                </li>
                <li class="footer-item">
                    <a href="tel:+71234567890" class="footer-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        +7 (XXX) XXX-XX-XX
                    </a>
                </li>
                <li class="footer-item">
                    <a href="#" class="footer-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        Колпино, б-р Трудящихся, д. 29/52
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p class="copyright">&copy; 2023 Pulse Education. Все права защищены.</p>
    </div>
</footer>
<style>


    :root {
        --opa: #3a56d4;
        --primary: #4361ee;
        --primary-dark: #3a56d4;
        --secondary: #f72585;
        --accent: #202020;
        --danger: #f72585;
        --success: #77E2D1;
        --dark: #202020;
        --light: #f8f9fa;
        --gray: #adb5bd;
        --white: #ffffff;
        --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        --border-radius: 12px;
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);

    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Montserrat', sans-serif;
        background-color: #f8fafc;
        color: #334155;
        line-height: 1.6;
        padding-top: 90px;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
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

    /* Header */
    header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 90px;
        background: var(--dark);
        box-shadow: var(--shadow);
        display: flex;
        align-items: center;
        z-index: 1000;
        padding: 0 2rem;
    }
    header img {
        width: 150px; /* Ширина логотипа */
        height: auto; /* Автоматическая высота для сохранения пропорций */
    }
    img {
        position: absolute;
        right: 2300px;
        width: 100px;
        height: 100px;
        top: 22px;

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
        transition: var(--transition);
    }

    .logo:hover {
        transform: scale(1.05);
    }

    /* Navigation */
    .nav-links {
        display: flex;
        gap: 1.5rem;
        align-items: center;
        margin: 0 auto;

    }

    .nav-link {
        color: var(--white);
        text-decoration: none;
        font-weight: 500;
        position: relative;
        padding: 0.5rem 0;
        transition: var(--transition);
    }

    .nav-link:hover {
        color: var(--success);
    }

    .nav-link::after {
        content: "";
        position: absolute;
        left: 50%;
        bottom: 5px; /* Увеличиваем значение, чтобы подчеркивание было ниже */
        width: 0; /* Начальная ширина 0 */
        height: 2px; /* Высота подчеркивания */
        background-color: #ffffff; /* Цвет подчеркивания */
        transition: width 0.3s ease, left 0.3s ease; /* Анимация ширины и позиции */
        transform: translateX(-50%);
    }

    .nav-link:hover::after {
        width: 50%; /* При наведении ширина становится 50% */
        left: 50%; /* Позиция слева остается 50% */
        transform: translateX(-50%);
    }

    /* Dropdown */
    .dropdown {
        position: relative;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        background: var(--white);
        min-width: 200px;
        box-shadow: var(--shadow);
        border-radius: var(--border-radius);
        opacity: 0;
        visibility: hidden;
        transition: var(--transition);
        z-index: 100;
        padding: 0.5rem 0;
    }

    .dropdown:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(5px);
    }

    .dropdown-item {
        display: block;
        padding: 0.75rem 1.5rem;
        color: var(--dark);
        text-decoration: none;
        transition: var(--transition);
    }

    .dropdown-item:hover {
        background: rgba(67, 97, 238, 0.1);
        color: var(--primary);
    }

    /* Burger Menu */
    .burger-menu {
        display: none;
        flex-direction: column;
        gap: 6px;
        cursor: pointer;
        z-index: 1001;
        padding: 10px;
    }

    .burger-line {
        width: 28px;
        height: 3px;
        background: var(--white);
        border-radius: 3px;
        transition: var(--transition);
    }

    .burger-menu.active .burger-line:nth-child(1) {
        transform: translateY(9px) rotate(45deg);
    }

    .burger-menu.active .burger-line:nth-child(2) {
        opacity: 0;
    }

    .burger-menu.active .burger-line:nth-child(3) {
        transform: translateY(-9px) rotate(-45deg);
    }

    /* Mobile Menu */
    .mobile-menu {
        position: fixed;
        top: 90px;
        left: 0;
        width: 100%;
        background: var(--dark);
        box-shadow: var(--shadow);
        transform: translateY(-100%);
        opacity: 0;
        transition: var(--transition);
        z-index: 999;
        padding: 1rem 0;
    }

    .mobile-menu.open {
        transform: translateY(0);
        opacity: 1;
    }

    .mobile-link {
        display: block;
        color: var(--white);
        text-decoration: none;
        padding: 1rem 2rem;
        transition: var(--transition);
        font-weight: 500;
    }

    .mobile-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: var(--accent);
    }

    /* Main Content */
    .main-container {
        width: 100%;
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 2rem;
    }

    /* Attendance Section */
    .attendance-section {
        background: var(--white);
        border-radius: var(--border-radius);
        box-shadow: var(--shadow);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--dark);
        position: relative;
        padding-bottom: 0.75rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--accent);
        border-radius: 2px;
    }

    /* Table */
    .attendance-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
    }

    .attendance-table thead {
        background: var(--dark);
        color: var(--white);
    }

    .attendance-table th {
        padding: 1rem;
        text-align: left;
        font-weight: 600;
    }

    .attendance-table td {
        padding: 1rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .attendance-table tr:last-child td {
        border-bottom: none;
    }

    .attendance-table tr:hover td {
        background: rgba(67, 97, 238, 0.05);
    }

    /* Status Badges */
    .status-badge {
        display: inline-block;
        padding: 0.35rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-present {
        background: #e6f7ee;
        color: #10b981;
    }

    .status-absent {
        background: #fee2e2;
        color: #ef4444;
    }

    .status-late {
        background: #fef3c7;
        color: #f59e0b;
    }

    /* Footer */
    footer {
        background: var(--dark);
        color: var(--white);
        padding: 3rem 0 1.5rem;
        margin-top: auto;

    }

    .footer-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        padding: 0 2rem;
    }

    .footer-section {
        margin-bottom: 1.5rem;
    }

    .footer-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1.25rem;
        color: var(--white);
        position: relative;
        padding-bottom: 0.5rem;
    }

    .footer-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background: var(--accent);
    }

    .footer-text {
        font-size: 0.9rem;
        color: var(--gray);
        line-height: 1.7;
        margin-bottom: 1rem;
    }

    .footer-list {
        list-style: none;
    }

    .footer-item {
        margin-bottom: 0.75rem;
    }

    .footer-link {
        color: var(--gray);
        text-decoration: none;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .footer-link:hover {
        color: #ffffff;
        transform: translateX(5px);
    }

    .social-links {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transition: var(--transition);
    }

    .social-link:hover {
        background: #202020;
        transform: translateY(-3px);
    }
    .social-link svg {
        fill: white; /* Если иконки используют fill */
        stroke: none; /* Убираем обводку если не нужна */
    }

    .footer-bottom {
        text-align: center;
        padding-top: 1.5rem;
        margin-top: 1.5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .copyright {
        font-size: 0.85rem;
        color: var(--gray);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .nav-links {
            display: none;
        }

        .burger-menu {
            display: flex;
        }
    }

    @media (max-width: 768px) {
        body {
            padding-top: 80px;
        }

        header {
            height: 80px;
            padding: 0 1.5rem;
        }

        .main-container {
            padding: 0 1.5rem;
        }

        .attendance-section {
            padding: 1.5rem;
        }

        .attendance-table th,
        .attendance-table td {
            padding: 0.75rem;
        }
    }

    @media (max-width: 576px) {
        .attendance-table {
            display: block;
            overflow-x: auto;
        }

        .footer-container {
            grid-template-columns: 1fr;
        }
    }


</style>

<!-- Подключаем Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
