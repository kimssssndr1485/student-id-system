<?php
define('APP_RUNNING', true);
ob_start(); // NEW LINE: lets modules redirect after the page has started

require_once __DIR__ . '/config.php';
require_once BASE_PATH . '/classes/Auth.php';

$auth = new Auth();
$auth->requireLogin(); // not logged in? sent to login.php

// Pages allowed to load: URL name => file in modules/
$pages = [
    'dashboard' => 'dashboard.php',
    'students'  => 'student_display.php',
    'add'       => 'student_add.php',
    'edit'      => 'student_edit.php',
    'search'    => 'student_search.php',
    'idcard'    => 'id_card.php',
];

$page = $_GET['page'] ?? 'dashboard';
if (!isset($pages[$page])) {
    $page = 'dashboard';
}

$pageTitle = 'Student ID Management System';
include BASE_PATH . '/components/head.php';
?>
<body>
    <?php include BASE_PATH . '/components/navbar.php'; ?>
    <div class="container">
        <?php include BASE_PATH . '/components/sidebar.php'; ?>
        <main class="content">
            <?php include BASE_PATH . '/modules/' . $pages[$page]; ?>
        </main>
    </div>
</body>
</html>