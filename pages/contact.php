<?php
$name = $email = $subject = $message = "";
$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    $sender = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';

    if (!$name || !$email || !$subject || !$message) {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } else {

        $stmt = $dbh->prepare("INSERT INTO messages (name, email, subject, message, sent_by) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $subject, $message, $sender]);

        header("Location: index.php?page=contact-success&name=" . urlencode($name));
        exit();
    }
}
?>

<h2>Contact Us</h2>

<?php if ($error): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endif; ?>

<form method="POST" onsubmit="return validateForm();">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($name) ?>"><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($email) ?>"><br>

    <label>Subject:</label><br>
    <input type="text" name="subject" value="<?= htmlspecialchars($subject) ?>"><br>

    <label>Message:</label><br>
    <textarea name="message" rows="5" cols="40"><?= htmlspecialchars($message) ?></textarea><br><br>

    <button type="submit">Send Message</button>
</form>

<script>
function validateForm() {
    const name = document.forms[0].name.value;
    const email = document.forms[0].email.value;
    const subject = document.forms[0].subject.value;
    const message = document.forms[0].message.value;

    if (!name || !email || !subject || !message) {
        alert("Please fill in all fields.");
        return false;
    }

    const emailRegex = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.match(emailRegex)) {
        alert("Please enter a valid email address.");
        return false;
    }

    return true;
}
</script>
