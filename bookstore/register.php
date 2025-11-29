<?php
// register.php
require 'dbconfig.php';

// Basic server-side validation (do not trust client)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.html');
    exit;
}

$name = trim($_POST['name'] ?? '');
$password = $_POST['password'] ?? '';
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$sex = $_POST['sex'] ?? '';
$dob_day = $_POST['dob_day'] ?? '';
$dob_month = $_POST['dob_month'] ?? '';
$dob_year = $_POST['dob_year'] ?? '';
$lang = isset($_POST['lang']) ? implode(',', $_POST['lang']) : '';
$address = $_POST['address'] ?? '';

// server validation
if (!preg_match('/^[A-Za-z\s]{6,}$/', $name)) {
    die('Invalid name. Name must be alphabetic and at least 6 characters.');
}
if (strlen($password) < 6) {
    die('Password must be at least 6 characters.');
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Invalid email.');
}
if (!preg_match('/^\d{10}$/', $phone)) {
    die('Phone must be exactly 10 digits.');
}

// hash password
$passHash = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare('INSERT INTO users (name, password_hash, email, phone, sex, dob, languages, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $dob = sprintf('%04d-%02d-%02d', intval($dob_year), intval($dob_month), intval($dob_day));
    $stmt->execute([$name, $passHash, $email, $phone, $sex, $dob, $lang, $address]);
    echo "<p>Registration successful. <a href='login.html'>Login here</a>.</p>";
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        echo "A user with that email already exists.";
    } else {
        echo "Error: " . htmlspecialchars($e->getMessage());
    }
}
?>
