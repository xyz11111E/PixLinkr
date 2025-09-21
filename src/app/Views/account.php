<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account - <?= $this->appName ?></title>
    <link rel="stylesheet" href="/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="/js/login.js"></script>
</head>
<body>
    <?php require __DIR__ . "/components/header.php"; ?>
    <main>
        <h1>Account</h1>
        <form action="/logout" method="POST">
            <button>Logout</button>
        </form>
    </main>
    <?php require __DIR__ . "/components/footer.php"; ?>
</body>
</html>