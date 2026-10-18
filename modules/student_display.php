<?php
defined('APP_RUNNING') or die('Access denied');
require_once BASE_PATH . '/classes/StudentList.php';

$list     = new StudentList();
$students = $list->all();
$added    = $_GET['added'] ?? '';
$updated  = $_GET['updated'] ?? '';
?>
<h2>Students</h2>

<?php if ($added !== ''): ?>
    <div class="success">Student added with ID <strong><?= htmlspecialchars($added) ?></strong>.</div>
<?php endif; ?>
<?php if ($updated !== ''): ?>
    <div class="success">Student <strong><?= htmlspecialchars($updated) ?></strong> was updated.</div>
<?php endif; ?>

<p>Total students: <strong><?= $list->count() ?></strong></p>

<table class="data-table">
    <thead>
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Course</th>
            <th>Year</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($students) === 0): ?>
            <tr><td colspan="5">No students yet.</td></tr>
        <?php endif; ?>

        <?php foreach ($students as $student): ?>
            <?php $sid = urlencode($student->getStudentId()); ?>
            <tr>
                <td><?= htmlspecialchars($student->getStudentId()) ?></td>
                <td><?= htmlspecialchars($student->getFullName()) ?></td>
                <td><?= htmlspecialchars($student->getCourse() ?: '-') ?></td>
                <td><?= htmlspecialchars($student->getYearLabel() ?: '-') ?></td>
                <td>
                    <a class="btn-small" href="<?= BASE_URL ?>/index.php?page=idcard&id=<?= $sid ?>">View ID</a>
                    <a class="btn-small" href="<?= BASE_URL ?>/index.php?page=edit&id=<?= $sid ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>