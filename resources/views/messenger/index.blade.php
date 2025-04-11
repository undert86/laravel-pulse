<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мессенджер | Pulse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --dark: #202020;
            --light: #f8f9fa;
            --gray: #adb5bd;
            --white: #ffffff;
            --light-gray: #e9ecef;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            height: 100vh;
            color: #333;
            overflow: hidden;
        }

        .messenger-container {
            display: flex;
            height: calc(100vh - 70px);
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-top: 70px;
        }

        .messenger-sidebar {
            width: 350px;
            border-right: 1px solid var(--light-gray);
            overflow-y: auto;
            background: var(--white);
            display: flex;
            flex-direction: column;
        }

        .messenger-header {
            padding: 18px 20px;
            border-bottom: 1px solid var(--light-gray);
            background: var(--dark);
            color: var(--white);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .messenger-header h3 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .search-box {
            position: relative;
            margin-top: 15px;
        }

        .search-box input {
            width: 100%;
            padding: 8px 15px 8px 40px;
            border: 1px solid var(--light-gray);
            border-radius: 20px;
            outline: none;
            background: var(--white);
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .search-box input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.2);
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 0.9rem;
        }

        .user-list {
            flex: 1;
            overflow-y: auto;
        }

        .user-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            cursor: pointer;
            transition: background 0.2s;
            border-bottom: 1px solid var(--light-gray);
        }

        .user-item:hover {
            background: rgba(67, 97, 238, 0.05);
        }

        .user-item.active {
            background: rgba(67, 97, 238, 0.1);
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
            background: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-info h4 {
            margin: 0;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-type {
            margin: 3px 0 0;
            font-size: 0.8rem;
            color: var(--gray);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .messenger-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #f5f7fb;
        }

        .conversation-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #999;
            padding: 20px;
            text-align: center;
        }

        .conversation-placeholder i {
            font-size: 60px;
            margin-bottom: 20px;
            color: #e0e0e0;
            opacity: 0.7;
        }

        .conversation-placeholder h3 {
            margin: 0 0 10px;
            font-size: 1.3rem;
            color: var(--dark);
            font-weight: 500;
        }

        .conversation-placeholder p {
            margin: 0;
            font-size: 0.9rem;
            color: var(--gray);
            max-width: 300px;
        }

        /* Header styles */
        .messenger-page-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            background: var(--dark);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            padding: 0 20px;
            z-index: 1000;
        }

        .messenger-page-header .logo {
            height: 34px;
            margin-right: 15px;
        }

        .messenger-page-header .back-btn {
            color: var(--white);
            text-decoration: none;
            margin-right: 15px;
            display: flex;
            align-items: center;
            font-size: 0.9rem;
        }

        .messenger-page-header .back-btn i {
            margin-right: 5px;
            font-size: 0.9rem;
        }

        .messenger-page-header .title {
            color: var(--white);
            font-size: 1.1rem;
            font-weight: 500;
            margin: 0;
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        @media (max-width: 768px) {
            .messenger-sidebar {
                width: 100%;
            }

            .messenger-container {
                flex-direction: column;
            }

            .messenger-content {
                display: none;
            }

            .messenger-content.active {
                display: flex;
            }
        }
    </style>
</head>
<body>
<header class="messenger-page-header">
    <a href="/" class="back-btn">
        <i class="fas fa-arrow-left"></i>
    </a>
    <img src="{{ Vite::asset('resources/svg/Pulse_logo.svg') }}" alt="Pulse" class="logo">
    <h1 class="title">Мессенджер</h1>
</header>

<div class="messenger-container">
    <div class="messenger-sidebar">
        <div class="messenger-header">
            <h3>Контакты</h3>
            <div class="search-box">
                <input type="text" id="search-contacts" placeholder="Поиск...">
                <i class="fas fa-search"></i>
            </div>
        </div>
        <div class="user-list">
            @foreach($users as $user)
                <div class="user-item" data-user-id="{{ $user->ID }}">
                    <div class="user-avatar">
                        <i class="fas fa-user" style="color: #666; font-size: 18px;"></i>
                    </div>
                    <div class="user-info">
                        <h4>{{ $user->LASTNAME }} {{ $user->FIRSTNAME }}</h4>
                        <p class="user-type">
                            @if($user->type == 0)
                                Студент
                            @elseif($user->type == 1)
                                Преподаватель
                            @else
                                Администратор
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="messenger-content">
        <div class="conversation-placeholder">
            <i class="fas fa-comments"></i>
            <h3>Выберите чат</h3>
            <p>Выберите пользователя из списка слева, чтобы начать общение</p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.user-item').click(function() {
            $('.user-item').removeClass('active');
            $(this).addClass('active');

            const userId = $(this).data('user-id');
            loadConversation(userId);

            // На мобильных устройствах показываем только контент чата
            if (window.innerWidth <= 768) {
                $('.messenger-sidebar').hide();
                $('.messenger-content').addClass('active').show();
            }
        });

        function loadConversation(userId) {
            $.get(`/messenger/conversation/${userId}`, function(data) {
                $('.messenger-content').html(data);
                scrollToBottom();
            });
        }

        function scrollToBottom() {
            const container = $('.messages-container');
            if (container.length) {
                container.scrollTop(container[0].scrollHeight);
            }
        }

        // Поиск контактов
        $('#search-contacts').on('input', function() {
            const searchText = $(this).val().toLowerCase();
            $('.user-item').each(function() {
                const userName = $(this).find('h4').text().toLowerCase();
                if (userName.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
</body>
</html>
