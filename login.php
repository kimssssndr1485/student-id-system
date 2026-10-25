<?php
include 'classes/Auth.php';

// Already logged in? Go to the system.
if (Auth::check()) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (Auth::login($username, $password)) {
        header('Location: index.php');
        exit;
    }
    $error = 'Incorrect username or password.';
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'components/head.php'; ?>
<body class="login-page">
    <div class="login-card">

        <div class="login-left">
            <img src="images/bcc-logo.png" alt="BCC logo" class="login-logo" onerror="this.style.display='none'">
            <h2>IRACC BCC</h2>
            <ul class="values">
                <li>Integrity</li>
                <li>Respect</li>
                <li>Accountability</li>
                <li>Courage</li>
                <li>Community</li>
            </ul>
        </div>

        <div class="login-right">
            <h1>Student ID Management System</h1>
            <p class="subtitle">Faculty Login</p>

            <?php if ($error !== '') : ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <input type="text" name="username" class="form-control mb-3" placeholder="Username" required autofocus>
                <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
                <button type="submit" class="btn btn-success w-100">Log In</button>
            </form>
        </div>

    </div>
</body>
</html>