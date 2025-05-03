<?php
if (!isset($_SESSION['username'])) {
    echo "<p style='color:red;'>You must be logged in to upload images.</p>";
    return;
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $uploadDir = 'uploads/';
    $fileName = basename($_FILES['image']['name']);
    $targetFile = $uploadDir . $fileName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check file type
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
        $error = "Only JPG, JPEG, and PNG files are allowed.";
    } elseif ($_FILES['image']['size'] > 2 * 1024 * 1024) {
        $error = "File is too large. Max 2MB allowed.";
    } elseif (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        $error = "There was an error uploading your file.";
    } else {
        $stmt = $dbh->prepare("INSERT INTO images (filename, uploaded_by) VALUES (?, ?)");
        $stmt->execute([$fileName, $_SESSION['username']]);
        $success = "Image uploaded successfully!";
    }
}
?>

<h2>Upload Image</h2>
<?php if ($error): ?><p style="color:red;"><?= $error ?></p><?php endif; ?>
<?php if ($success): ?><p style="color:green;"><?= $success ?></p><?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="image" accept="image/*" required><br><br>
    <button type="submit">Upload</button>
</form>

<h3>Uploaded Images</h3>
<div style="display:flex; flex-wrap:wrap; gap:10px;">
<?php
$stmt = $dbh->query("SELECT * FROM images ORDER BY uploaded_at DESC");
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($images as $img):
?>
    <div style="width:150px; text-align:center;">
        <img src="uploads/<?= htmlspecialchars($img['filename']) ?>" alt="" style="width:100%; height:auto;"><br>
        <small><?= htmlspecialchars($img['uploaded_by']) ?><br><?= $img['uploaded_at'] ?></small>
    </div>
<?php endforeach; ?>
</div>

