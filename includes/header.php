<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Commercial Site</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <?php foreach ($menu as $key => $value): ?>
                    <?php if (($key == 'login' && !isset($_SESSION['user'])) || ($key == 'logout' && isset($_SESSION['user'])) || !in_array($key, ['login', 'logout'])): ?>
                        <li><a href="?page=<?= $key ?>"><?= $value ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </nav>

        <?php if (isset($_SESSION['user'])): ?>
            <p>Logged in: <?= $_SESSION['family_name'] . ' ' . $_SESSION['surname'] ?> (<?= $_SESSION['username'] ?>)</p>
        <?php endif; ?>
    </header>



