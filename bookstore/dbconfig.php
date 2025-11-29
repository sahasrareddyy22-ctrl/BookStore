<?php
// dbconfig.php
// Update with your DB credentials
$DB_HOST = 'localhost';
$DB_NAME = 'bookstore';
$DB_USER = 'bookuser';
$DB_PASS = 'bookpass';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo "Database connection failed: " . htmlspecialchars($e->getMessage());
    exit;
}
?>
