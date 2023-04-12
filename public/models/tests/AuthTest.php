<?php
require_once('Auth.php');

// Test login
$auth = new Auth();
var_dump($auth->login('janinemilenadalchiavon@gmail.com', 'admin'));
var_dump($auth->login('janinemilenadalchiavon@gmail.com', 'wrongpassword'));
var_dump($auth->login('nonexistent@example.com', 'password123'));

// Test checkPermission
var_dump($auth->checkPermission(1));
var_dump($auth->checkPermission(2));

// Test logout
$auth->logout();
var_dump(session_status() == PHP_SESSION_NONE);
?>

