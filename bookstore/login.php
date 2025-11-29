<?php
// login.php
require 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.html');
    exit;
}
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Invalid email.');
}

$stmt = $pdo->prepare('SELECT id, name, password_hash FROM users WHERE email = ? LIMIT 1');
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user || !password_verify($password, $user['password_hash'])) {
    echo "<p>Login failed. <a href='login.html'>Try again</a>.</p>";
    exit;
}

// In a real app, start session and store user info
session_start();
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];

echo "<p>Welcome, " . htmlspecialchars($user['name']) . "! You are logged in.</p>";
echo "<p><a href='index.html'>Go to Home</a></p>";
?>
