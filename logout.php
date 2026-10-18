<?php
require_once __DIR__ . '/config.php';
require_once BASE_PATH . '/classes/Auth.php';

$auth = new Auth();
$auth->logout();

header('Location: ' . BASE_URL . '/login.php');
exit;
