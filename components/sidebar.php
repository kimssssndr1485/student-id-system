<?php $current = $_GET['page'] ?? 'dashboard'; ?>
<div class="sidebar">
    <a href="index.php?page=dashboard" class="<?php echo $current === 'dashboard' ? 'active' : ''; ?>">Dashboard</a>
    <a href="index.php?page=students" class="<?php echo in_array($current, ['students', 'idcard', 'edit']) ? 'active' : ''; ?>">Students</a>
    <a href="index.php?page=add" class="<?php echo $current === 'add' ? 'active' : ''; ?>">Add Student</a>
    <a href="index.php?page=search" class="<?php echo $current === 'search' ? 'active' : ''; ?>">Search</a>
</div>