<?php
$host = 'db';          // ชื่อ service ใน docker-compose.yml
$db = 'sample_db';   // ชื่อ database ที่สร้างให้อัตโนมัติใน compose
$user = 'admin';       // user ตาม compose
$pass = '1234';        // password ตาม compose
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Connected database server<br>";
    echo "Selected database";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>