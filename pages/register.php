<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $family_name = trim($_POST['family_name']);
    $surname = trim($_POST['surname']);

    if ($username && $password && $family_name && $surname) {
        $stmt = $dbh->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        
        if ($stmt->rowCount() > 0) {
            $error = "Username already taken.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $dbh->prepare("INSERT INTO users (username, password, family_name, surname) VALUES (?, ?, ?, ?)");
            $stmt->execute([$username, $hashed_password, $family_name, $surname]);

            $success = "Registration successful! You can now login.";
        }
    } else {
        $error = "Please fill all fields.";
    }
}
?>

<h2>Register</h2>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <p style="color:green;"><?= $success ?></p>
<?php endif; ?>

<form method="POST" action="">
    <label>Family Name:</label><br>
    <input type="text" name="family_name" required><br><br>

    <label>Surname:</label><br>
    <input type="text" name="surname" required><br><br>

    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Register</button>
</form>
