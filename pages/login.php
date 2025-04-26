<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username && $password) {
        $stmt = $dbh->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['family_name'] = $user['family_name'];
            $_SESSION['surname'] = $user['surname'];

            header('Location: index.php?page=home');
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Please fill all fields.";
    }
}
?>

<h2>Login</h2>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endif; ?>

<form method="POST" action="">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>
