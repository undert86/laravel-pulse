<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Выставление оценок | Pulse</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ Vite::asset('resources/svg/Union.svg') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #202020;
            --primary-dark: #161616;
            --secondary: #4361ee;
            --accent: #77E2D1;
            --danger: #f72585;
            --success: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
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

        .header-container {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .chat-item:hover {
            background-color: rgba(67, 97, 238, 0.1);
        }

        #chatMessages {
            scrollbar-width: thin;
            scrollbar-color: #4361ee #f1f1f1;
        }

        #chatMessages::-webkit-scrollbar {
            width: 6px;
        }

        #chatMessages::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #chatMessages::-webkit-scrollbar-thumb {
            background-color: #4361ee;
            border-radius: 6px;
        }

        .avatar {
            flex-shrink: 0;
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
            bottom: 5px;
            width: 0;
            height: 2px;
            background-color: #ffffff;
            transition: width 0.3s ease, left 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 50%;
            left: 50%;
            transform: translateX(-50%);
        }

        /* Main Content */
        .main-container {
            width: 100%;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
            flex: 1;
        }

        /* Forms */
        .form-container {
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .form-container h2 {
            color: var(--primary);
            margin-bottom: 1.5rem;
            font-weight: 600;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .form-container h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--accent);
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-container label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }

        .form-container select,
        .form-container input,
        .form-container textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border: 1px solid var(--gray);
            border-radius: var(--border-radius);
            font-family: 'Montserrat', sans-serif;
            transition: var(--transition);
            background-color: var(--light);
        }

        .form-container select:focus,
        .form-container input:focus,
        .form-container textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(119, 226, 209, 0.2);
        }

        .btn {
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 0.75rem 1.75rem;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn:hover {
            background: var(--accent);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(119, 226, 209, 0.3);
        }

        .btn-primary {
            background: var(--secondary);
        }

        .btn-primary:hover {
            background: #3a56d8;
        }

        /* Tables */
        .grades-table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            box-shadow: var(--shadow);
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .grades-table th {
            background: var(--primary);
            color: var(--white);
            padding: 1rem;
            text-align: left;
            font-weight: 500;
        }

        .grades-table td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .grades-table tr:last-child td {
            border-bottom: none;
        }

        .grades-table tr:hover td {
            background-color: rgba(119, 226, 209, 0.1);
        }

        /* Grade badges */
        .grade-badge {
            display: inline-flex;
            width: 32px;
            height: 32px;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: white;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .grade-5 { background-color: #28a745; }
        .grade-4 { background-color: #17a2b8; }
        .grade-3 { background-color: #ffc107; color: #212529; }
        .grade-2 { background-color: #dc3545; }

        /* Attendance status */
        .attendance-status {
            display: inline-block;
            padding: 0.35rem 0.85rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .status-present {
            background-color: #d4edda;
            color: #155724;
        }

        .status-absent {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Footer */
        footer {
            background: var(--primary);
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

        .footer-section h3 {
            font-size: 1.1rem;
            margin-bottom: 1.25rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .footer-section h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--accent);
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section li {
            margin-bottom: 0.5rem;
        }

        .footer-section a {
            color: var(--white);
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-section a:hover {
            color: var(--accent);
            padding-left: 5px;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 1.5rem;
            margin-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding-top: 80px;
            }

            .nav-links {
                display: none;
            }

            .grades-table {
                display: block;
                overflow-x: auto;
            }

            .form-container {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
<header>
    <div class="header-container">
        <img src="{{ Vite::asset('resources/svg/Pulse_logo.svg') }}" alt="Logo" class="logo">

        <nav class="nav-links">
            <a href="" class="nav-link">Главная</a>
            <a href="" class="nav-link">Оценки</a>
            <a href="{{ route('messenger') }}" class="nav-link" id="messenger-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
                Мессенджер
            </a>
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
    <div class="form-container">
        <h2>Выставление оценок</h2>
        <form action="{{ route('teacher.grades.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="student_id">Студент:</label>
                <select name="student_id" id="student_id" class="form-control" required>
                    @foreach($students as $student)
                        <option value="{{ $student->ID }}">
                            {{ $student->LASTNAME }} {{ $student->FIRSTNAME }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="subject_id">Предмет:</label>
                <select name="subject_id" id="subject_id" class="form-control" required>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->subject_id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="grade">Оценка:</label>
                <select name="grade" id="grade" class="form-control" required>
                    <option value="5">5 (Отлично)</option>
                    <option value="4">4 (Хорошо)</option>
                    <option value="3">3 (Удовлетворительно)</option>
                    <option value="2">2 (Неудовлетворительно)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="comment">Комментарий:</label>
                <textarea name="comment" id="comment" rows="3" class="form-control" placeholder="Необязательный комментарий..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 8px;">
                    <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2h-2a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h2V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                </svg>
                Сохранить оценку
            </button>
        </form>
    </div>

    <div class="form-container">
        <h2>Выставленные оценки</h2>
        <table class="grades-table">
            <thead>
            <tr>
                <th>Студент</th>
                <th>Предмет</th>
                <th>Оценка</th>
                <th>Дата</th>
                <th>Комментарий</th>
            </tr>
            </thead>
            <tbody>
            @foreach($grades as $grade)
                <tr>
                    <td>
                        @if($grade->student)
                            {{ $grade->student->LASTNAME }} {{ $grade->student->FIRSTNAME }}
                        @else
                            Неизвестный студент
                        @endif
                    </td>
                    <td>
                        @if($grade->subject)
                            {{ $grade->subject->name }}
                        @else
                            Неизвестный предмет
                        @endif
                    </td>
                    <td>
                        <span class="grade-badge grade-{{ $grade->grade }}">
                            {{ $grade->grade }}
                        </span>
                    </td>
                    <td>{{ date('d.m.Y', strtotime($grade->date)) }}</td>
                    <td>{{ $grade->comment ?? '-' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="form-container">
        <h2>Посещаемость студентов</h2>
        <form action="{{ route('teacher.attendance.mark') }}" method="POST" class="mb-4">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="attendance_student_id">Студент:</label>
                        <select name="student_id" id="attendance_student_id" class="form-control" required>
                            @foreach($students as $student)
                                <option value="{{ $student->ID }}">
                                    {{ $student->LASTNAME }} {{ $student->FIRSTNAME }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="attendance_subject_id">Предмет:</label>
                        <select name="subject_id" id="attendance_subject_id" class="form-control" required>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->subject_id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="date">Дата:</label>
                        <input type="date" name="date" id="date" class="form-control" required value="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="status">Статус:</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="present">Присутствовал</option>
                            <option value="absent">Отсутствовал</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 8px;">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Сохранить
                    </button>
                </div>
            </div>
        </form>

        <table class="grades-table">
            <thead>
            <tr>
                <th>Студент</th>
                <th>Предмет</th>
                <th>Дата</th>
                <th>Статус</th>
            </tr>
            </thead>
            <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>
                        @if($attendance->student)
                            {{ $attendance->student->LASTNAME }} {{ $attendance->student->FIRSTNAME }}
                        @else
                            Неизвестный студент
                        @endif
                    </td>
                    <td>
                        @if($attendance->subject)
                            {{ $attendance->subject->name }}
                        @else
                            Неизвестный предмет
                        @endif
                    </td>
                    <td>{{ date('d.m.Y', strtotime($attendance->date)) }}</td>
                    <td>
                        <span class="attendance-status status-{{ $attendance->status }}">
                            {{ $attendance->status == 'present' ? 'Присутствовал' : 'Отсутствовал' }}
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</main>

<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>О нас</h3>
            <p>Мы — современная образовательная платформа, помогающая учителям и студентам взаимодействовать эффективно и удобно.</p>
        </div>
        <div class="footer-section">
            <h3>Ссылки</h3>
            <ul>
                <li><a href="">Главная</a></li>
                <li><a href="">Оценки</a></li>
                <li><a href="">Расписание</a></li>
                <li><a href="">Новости</a></li>
                <li><a href="obrasheniya.php">Есть вопрос?</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Контакты</h3>
            <ul>
                <li>Email: support@pulse.edu</li>
                <li>Телефон: +7 (XXX) XXX-XX-XX</li>
                <li>Адрес: Колпино, б-р Трудящихся, д. 29/52</li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2023 Pulse Education. Все права защищены.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<!-- Messenger Modal -->

</html>
