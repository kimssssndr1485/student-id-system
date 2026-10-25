<div class="topbar">
    <span class="brand">
        <img src="images/bcc-logo.png" alt="BCC logo" class="topbar-logo" onerror="this.style.display='none'">
        Student ID Management System
    </span>
    <span>
        Hello, <?php echo Auth::username(); ?>
        <a href="logout.php" class="btn btn-outline-light btn-sm ms-2">Logout</a>
    </span>
</div>