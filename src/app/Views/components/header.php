<?php
    $isLoggedIn = isset($_SESSION['user_id']);
    $username = $_SESSION['username'] ?? 'Пользователь';
?>

<header>
    <h1><a href="/">PixLinkr</a></h1>
    <a href="/set-lang?lang=en">En</a>
    <a href="/set-lang?lang=ro">Ro</a>
    <a href="/set-lang?lang=ru">Ru</a>
    <nav class="nav">
        <?php if ($isLoggedIn): ?>
            <a href="/account">Профиль</a>
            <a href="/new_album">добавить альбом</a>
        <?php else: ?>
            <a href="/login.php">Войти</a>
            <a href="/register.php">Регистрация</a>
        <?php endif; ?>
    </nav>
</header>