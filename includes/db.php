<?php

$dsn = 'mysql:host=localhost;dbname=commercialdb;charset=utf8';
$user = 'commercialdb';
$pass = 'Enkhjee123';

try {
    $dbh = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    echo "DB Error: " . $e->getMessage();
    exit;
}
?>
