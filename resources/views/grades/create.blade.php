<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Выставление оценок</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="Union.svg" type="ico">
    <style>
        /* Стили для вертикальной формы */
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 5%;
            overflow: hidden;
        }

        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-container select,
        .form-container textarea,
        .form-container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-container textarea {
            width: 95%;
            resize: vertical;
            height: 100px;
        }

        .form-container button {
            background-color: black;
            color: white;
            border: none;
            cursor: pointer;
            margin-left: 0.5%;
        }

        .form-container button:hover {
            background-color: #79D0C2;
        }

        .success-message {
            font-family: "Montserrat", serif;
            color: green;
            text-align: center;
            margin-top: 16px;
        }

        /* Стили для таблицы оценок */
        .grades-table {
            font-family: "Montserrat", sans-serif;
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .grades-table th, .grades-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .grades-table th {
            background-color: #f4f4f4;
            font-weight: 600;
        }
        .grades-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .grades-table tr:hover {
            background-color: #f1f1f1;
        }

        /* Стили для оценок */
        .grade-5 {
            background-color: #52af56; /* Зелёный */
            color: white;
        }
        .grade-4 {
            background-color: #ddaa51; /* Синий */
            color: white;
        }
        .grade-3 {
            background-color: #c7bc59; /* Жёлтый */
            color: white;
        }
        .grade-2 {
            background-color: #d1534a; /* Оранжевый */
            color: white;
        }

    </style>
</head>
<body>
<header>
    <div class="container">
        <img src="Pulse_logo.svg" alt="Logo" href="profile.php">
        <nav class="nav-links">
            <a href="teacher_dashboard.php" class="link">Главная</a>
            <div class="dropdown">
                <a href="#" class="link">Оценки</a>
                <div class="dropdown-menu">
                    <a href="addgrades.php" class="link active">Выставить</a>
                    <a href="added_grades.php">Выставленные оценки</a>
                </div>
            </div>

            <div class="dropdown">
                <a href="#" class="link">Расписание</a>
                <div class="dropdown-menu">
                    <a href="one.php">1 курс</a>
                    <a href="#">2 курс</a>
                    <a href="#">3 курс</a>
                </div>
            </div>

            <a href="#" class="link">Новости</a>
            <a href="#" class="link">О сайте</a>
            <a href="obrasheniya1.php" class="link">Есть вопрос?</a>
        </nav>

        <div class="user-info">
            <span><?php echo htmlspecialchars($user_name); ?></span>
            <a href="logout.php" class="logout-btn">Выйти</a>
        </div>
    </div>
</header>

<!-- Форма для отметки посещаемости -->



<div class="form-container">

    <h3>Выставить оценку</h3>
    <form action="{{ route('grades.store') }}" method="POST">
        @csrf

        <label for="student_id">Выберите студента:</label>
        <select name="student_id" required>
            @foreach($students as $student)
                <option value="{{ $student->id }}">
                    {{ $student->lastname }} {{ $student->firstname }}
                </option>
            @endforeach
        </select>

        <label for="subject_id">Предмет:</label>
        <select name="subject_id" required>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endforeach
        </select>

        <label for="grade">Оценка:</label>
        <select name="grade" required>
            <option value="5">5 (Отлично)</option>
            <option value="4">4 (Хорошо)</option>
            <option value="3">3 (Удовлетворительно)</option>
            <option value="2">2 (Неудовлетворительно)</option>
        </select>

        <label for="date">Дата:</label>
        <input type="date" name="date" required>

        <label for="comment">Комментарий:</label>
        <textarea name="comment" placeholder="Необязательный комментарий"></textarea>

        <button type="submit" class="submit-btn">Выставить оценку</button>

        @if(session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif
    </form>
</div>

<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>О нас</h3>
            <p>Мы — современная образовательная платформа, помогающая учителям и студентам взаимодействовать эффективно и удобно.</p>
        </div>
        <div class="footer-section">
            <h3>Ссылки</h3>
            <ul>
                <li><a href="addgrades.php">Главная</a></li>
                <li><a href="teacher_dashboard.php">Выставление оценок</a></li>
                <li><a href="added_grades.php">Выставленные оценки</a></li>
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
        <div class="footer-section">
            <h3>Социальные сети</h3>
            <ul class="social-links">
                <li><a href="#" target="_blank"><img src="path/to/facebook-icon.svg" alt="Facebook"></a></li>
                <li><a href="#" target="_blank"><img src="path/to/twitter-icon.svg" alt="Twitter"></a></li>
                <li><a href="#" target="_blank"><img src="path/to/instagram-icon.svg" alt="Instagram"></a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2023 Pulse Education. Все права защищены.</p>
    </div>
</footer>

<style>
    body {
        overflow: hidden;
    }
    footer {
        background-color: #f4f4f4;
        padding: 40px 20px;
        font-family: "Montserrat", sans-serif;
        margin-top: 10%;
        border-top: 1px solid #ddd;

    }

    .footer-container {
        display: flex;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
        flex-wrap: wrap;

    }

    .footer-section {
        flex: 1;
        min-width: 200px;
        margin: 10px 20px;
    }

    .footer-section h3 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
    }

    .footer-section p, .footer-section ul {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
    }

    .footer-section ul {
        list-style: none;
        padding: 0;
    }

    .footer-section ul li {
        margin-bottom: 8px;
    }

    .footer-section ul li a {
        color: #666;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .footer-section ul li a:hover {
        color: #79D0C2;
    }

    .social-links {
        display: flex;
        gap: 10px;
    }

    .social-links img {
        width: 24px;
        height: 24px;
        transition: opacity 0.3s ease;
    }

    .social-links img:hover {
        opacity: 0.7;
    }

    .footer-bottom {
        text-align: center;
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #ddd;
        font-size: 14px;
        color: #666;
    }
</style>
</head>
</body>

</body>
</html>
