<?php
$name = $_GET['name'] ?? 'Guest';
?>

<h2>Thank you, <?= htmlspecialchars($name) ?>!</h2>
<p>Your message has been sent successfully.</p>
<p>We'll get back to you as soon as possible.</p>
