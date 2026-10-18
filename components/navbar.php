<nav class="navbar">
    <span class="brand"><h2>Student ID Management System</h2></span>
    <span class="nav-right">
        Hello, <?= htmlspecialchars($_SESSION['username'] ?? '') ?>
        <a href="<?= BASE_URL ?>/logout.php">Logout</a>
    </span>
</nav>
