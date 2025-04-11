<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Чат | Pulse</title>
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

        .messenger-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #f5f7fb;
            width: 100%;
        }

        .conversation-header {
            padding: 15px 20px;
            border-bottom: 1px solid var(--light-gray);
            display: flex;
            align-items: center;
            background: var(--white);
            position: sticky;
            top: -100%;
            
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

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 12px;
            background: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .user-avatar i {
            color: #666;
            font-size: 16px;
        }

        .user-info-text h3 {
            margin: 0;
            font-size: 1rem;
            font-weight: 500;
            color: var(--dark);
        }

        .user-status {
            margin: 2px 0 0;
            font-size: 0.8rem;
            color: var(--gray);
        }

        .messages-container {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background: #f5f7fb;
            display: flex;
            flex-direction: column;
        }

        .message {
            display: flex;
            margin-bottom: 12px;
            max-width: 75%;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .message.sent {
            align-self: flex-end;
        }

        .message.received {
            align-self: flex-start;
        }

        .message-content {
            padding: 10px 15px;
            border-radius: 18px;
            position: relative;
            word-wrap: break-word;
            line-height: 1.4;
            font-size: 0.95rem;
        }

        .message.sent .message-content {
            background: var(--primary);
            color: var(--white);
            border-bottom-right-radius: 4px;
        }

        .message.received .message-content {
            background: var(--white);
            color: var(--dark);
            border-bottom-left-radius: 4px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.08);
        }

        .message-time {
            display: block;
            font-size: 0.7rem;
            margin-top: 4px;
            opacity: 0.8;
            text-align: right;
        }

        .message-input-container {
            padding: 15px;
            border-top: 1px solid var(--light-gray);
            background: var(--white);
            position: sticky;
            bottom: 0;
        }

        .message-input-form {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .message-input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid var(--light-gray);
            border-radius: 20px;
            outline: none;
            font-family: inherit;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .message-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.2);
        }

        .send-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: var(--primary);
            color: var(--white);
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
            flex-shrink: 0;
        }

        .send-btn:hover {
            background: var(--primary-dark);
        }

        .send-btn i {
            font-size: 1rem;
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
            .message {
                max-width: 85%;
            }

            .messages-container {
                padding: 15px;
            }

            .message-content {
                padding: 8px 12px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
<header class="messenger-page-header">
    <a href="/messenger" class="back-btn" id="back-to-contacts">
        <i class="fas fa-arrow-left"></i>
    </a>
    <img src="{{ Vite::asset('resources/svg/Pulse_logo.svg') }}" alt="Pulse" class="logo">
    <h1 class="title">Мессенджер</h1>
</header>

<div class="messenger-container">
    <div class="messenger-content">
        <div class="conversation-header">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <div class="user-info-text">
                    <h3>{{ $receiver->LASTNAME }} {{ $receiver->FIRSTNAME }}</h3>
                    <p class="user-status">
                        @if($receiver->type == 0)
                            Студент
                        @elseif($receiver->type == 1)
                            Преподаватель
                        @else
                            Администратор
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="messages-container" id="messages-container">
            @foreach($messages as $message)
                <div class="message {{ $message->sender_id == Auth::id() ? 'sent' : 'received' }}" data-message-id="{{ $message->id }}">
                    <div class="message-content">
                        <p>{{ $message->message }}</p>
                        <span class="message-time">{{ date('H:i', strtotime($message->created_at)) }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="message-input-container">
            <form class="message-input-form" id="send-message-form">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $receiver->ID }}">
                <input type="text" name="message" class="message-input" placeholder="Введите сообщение..." autocomplete="off" required>
                <button type="submit" class="send-btn">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Автоматическая прокрутка вниз при загрузке
        scrollToBottom();

        // Обработка кнопки "Назад" на мобильных устройствах
        $('#back-to-contacts').click(function(e) {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                $('.messenger-content').hide();
                $('.messenger-sidebar').show();
                history.pushState(null, null, '/messenger');
            }
        });

        // Отправка сообщения
        $('#send-message-form').submit(function(e) {
            e.preventDefault();
            const form = $(this);
            const messageInput = form.find('.message-input');
            const message = messageInput.val().trim();

            if (message) {
                $.ajax({
                    url: '/messenger/send',
                    method: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            // Добавляем новое сообщение в чат
                            const now = new Date();
                            const timeString = now.getHours().toString().padStart(2, '0') + ':' +
                                now.getMinutes().toString().padStart(2, '0');

                            const messageHtml = `
                                <div class="message sent" data-message-id="${response.message_id}">
                                    <div class="message-content">
                                        <p>${message}</p>
                                        <span class="message-time">${timeString}</span>
                                    </div>
                                </div>
                            `;
                            $('#messages-container').append(messageHtml);
                            messageInput.val('');
                            scrollToBottom();
                        }
                    },
                    error: function(xhr) {
                        console.error('Ошибка при отправке сообщения:', xhr.responseText);
                    }
                });
            }
        });

        // Периодическая проверка новых сообщений (каждые 3 секунды)
        const receiverId = $('input[name="receiver_id"]').val();
        let lastMessageId = $('.message').last().data('message-id') || 0;

        setInterval(function() {
            checkNewMessages(receiverId, lastMessageId);
        }, 3000);

        function checkNewMessages(userId, lastId) {
            $.get(`/messenger/new-messages/${userId}?last_id=${lastId}`, function(messages) {
                if (messages.length > 0) {
                    messages.forEach(message => {
                        const timeString = new Date(message.created_at).toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        });

                        const messageHtml = `
                            <div class="message received" data-message-id="${message.id}">
                                <div class="message-content">
                                    <p>${message.message}</p>
                                    <span class="message-time">${timeString}</span>
                                </div>
                            </div>
                        `;
                        $('#messages-container').append(messageHtml);
                        lastMessageId = message.id;
                    });
                    scrollToBottom();
                }
            }).fail(function(xhr) {
                console.error('Ошибка при проверке новых сообщений:', xhr.responseText);
            });
        }

        function scrollToBottom() {
            const container = $('#messages-container');
            container.scrollTop(container[0].scrollHeight);
        }
    });
</script>
</body>
</html>
