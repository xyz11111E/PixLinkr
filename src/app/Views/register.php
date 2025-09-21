<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - <?= $this->appName ?></title>
    <link rel="stylesheet" href="/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="/js/register.js"></script>
</head>
<body>
    <?php require __DIR__ . "/components/header.php"; ?>
    <main>
        <h1>Register</h1>
        <form id="register-form">
            <input type="text" name="username" placeholder="Username" min="2" required>
            <input type="text" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" min="8" required>
            <input type="password" name="password_confirmation" placeholder="Confirm password" min="8" required>
            <button type="submit">Register</button>
        </form>
        <p id="form-error"></p>
        <p id="form-success"></p>
        <a href="/login">Already have an account? Login</a>
    </main>
    <?php require __DIR__ . "/components/footer.php"; ?>
</body>
</html>