<?php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=commercialdb', 'commercialdb', 'Enkhjee123', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$menu = [
    'home' => 'Home',
    'login' => 'Login',
    'register' => 'Register',
    'upload' => 'Gallery',
    'contact' => 'Contact',
    'messages' => 'Messages',
    'logout' => 'Logout'
];

session_start();
?>
