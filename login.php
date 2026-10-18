<?php
require_once __DIR__ . '/config.php';
require_once BASE_PATH . '/classes/Auth.php';

$auth  = new Auth();
$error = '';

// Already logged in? Go straight to the system.
if ($auth->isLoggedIn()) {
    header('Location: ' . BASE_URL . '/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($auth->login($username, $password)) {
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }
    $error = 'Incorrect username or password.';
}

$pageTitle = 'Faculty Login';
include BASE_PATH . '/components/head.php';
?>
<body class="login-page">
    <div class="login-card">

        <!-- Left panel: BCC description naton -->
        <div class="login-left">
            <img src="<?= BASE_URL ?>/assets/images/bcc-logo.png" alt="BCC logo"
                 class="login-logo" onerror="this.style.display='none'">
            <h2>IRACC BCC</h2>
            <ul class="values">
                <li>Integrity</li>
                <li>Respect</li>
                <li>Accountability</li>
                <li>Courage</li>
                <li>Community</li>
            </ul>
        </div>

        <!-- Right panel: login form -->
        <div class="login-right">
            <h1>Student ID Management System</h1>
            <p class="subtitle">Faculty Login</p>

            <?php if ($error !== ''): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <input type="text" name="username" placeholder="Username" required autofocus>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Log In</button>
            </form>
        </div>

    </div>
</body>
</html>
