<?php $current = $_GET['page'] ?? 'dashboard'; ?>
<div class="sidebar">
    <a href="index.php?page=dashboard" class="<?php echo $current === 'dashboard' ? 'active' : ''; ?>">Dashboard</a>
    <a href="index.php?page=students" class="<?php echo ($current === 'students' || $current === 'idcard') ? 'active' : ''; ?>">Students</a>
</div>