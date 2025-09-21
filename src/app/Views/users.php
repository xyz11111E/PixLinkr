<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - <?= $this->appName ?></title>
</head>
<body>
    <?php require __DIR__ . "/components/dashboard_nav.php"; ?>
    <main>
        <section>
            <h1>Users</h1>
        </section>
        
        <section>
            <h2>Users List:</h2>

            <?php
                if (count($users) > 0)
                {
                    echo "<ul>";
                        foreach ($users as $user)
                        {
                            echo "<li>
                                <p>Username: <strong>{$user['username']}</strong></p>
                                <p>Email: <strong>{$user['email']}</strong></p>
                                <div>
                                    <a href='/user?id={$user['id']}'>Update User</a>
                                </div>
                            </li>";
                        }
                    echo "</ul>";
                }
                else
                {
                    echo "<p>No users in users table.</p>";
                }
            ?>
        </section>
    </main>
    <?php require __DIR__ . "/components/dashboard_footer.php"; ?>
</body>
</html>