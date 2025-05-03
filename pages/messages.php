<?php
if (!isset($_SESSION['user'])) {
    echo "<p>You must be logged in to view messages.</p>";
    return;
}

$stmt = $dbh->query("SELECT * FROM messages ORDER BY sent_at DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Received Messages</h2>

<?php if (count($messages) === 0): ?>
    <p>No messages found.</p>
<?php else: ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Sent By</th>
            <th>Sent At</th>
        </tr>
        <?php foreach ($messages as $msg): ?>
            <tr>
                <td><?= htmlspecialchars($msg['name']) ?></td>
                <td><?= htmlspecialchars($msg['email']) ?></td>
                <td><?= htmlspecialchars($msg['subject']) ?></td>
                <td><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
                <td><?= htmlspecialchars($msg['sent_by']) ?></td>
                <td><?= $msg['sent_at'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
