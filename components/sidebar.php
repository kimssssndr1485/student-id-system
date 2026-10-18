<?php $current = $_GET['page'] ?? 'dashboard'; ?>
<aside class="sidebar">
    <a href="<?= BASE_URL ?>/index.php?page=dashboard" class="<?= $current === 'dashboard' ? 'active' : '' ?>">Dashboard</a>
    <a href="<?= BASE_URL ?>/index.php?page=students"  class="<?= $current === 'students'  ? 'active' : '' ?>">Students</a>
    <a href="<?= BASE_URL ?>/index.php?page=add"       class="<?= $current === 'add'       ? 'active' : '' ?>">Add Student</a>
    <a href="<?= BASE_URL ?>/index.php?page=search"    class="<?= $current === 'search'    ? 'active' : '' ?>">Search</a>
    <a href="<?= BASE_URL ?>/index.php?page=idcard"    class="<?= $current === 'idcard'    ? 'active' : '' ?>">ID Card</a>
</aside>
