<?php
defined('APP_RUNNING') or die('Access denied');
require_once BASE_PATH . '/classes/StudentList.php';

$list    = new StudentList();
$id      = $_GET['id'] ?? '';
$student = $list->find($id);

// Work out the photo address (with a cache-buster so a new photo shows right away).
$photoUrl = '';
if ($student !== null && $student->getPhoto() !== '') {
    $file = BASE_PATH . '/assets/uploads/photos/' . $student->getPhoto();
    if (file_exists($file)) {
        $photoUrl = BASE_URL . '/assets/uploads/photos/' . rawurlencode($student->getPhoto()) . '?v=' . filemtime($file);
    }
}
?>
<h2>ID Card</h2>

<?php if ($student === null): ?>
    <p>Student not found. <a href="<?= BASE_URL ?>/index.php?page=students">Go to the student list</a> and click "View ID".</p>
<?php else: ?>

    <div class="id-card">
        <div class="id-card-header">
            <img src="<?= BASE_URL ?>/assets/images/bcc-logo.png" alt="" onerror="this.style.display='none'">
            <span>IRACC BCC</span>
        </div>

        <div class="id-card-main">
            <div class="id-photo">
                <?php if ($photoUrl !== ''): ?>
                    <img src="<?= $photoUrl ?>" alt="Student photo">
                <?php else: ?>
                    <span>No photo</span>
                <?php endif; ?>
            </div>
            <div class="id-info">
                <p class="id-name"><?= htmlspecialchars($student->getFullName()) ?></p>
                <p class="id-course"><?= htmlspecialchars($student->getCourse() ?: 'Course not set') ?></p>
                <p class="id-year"><?= htmlspecialchars($student->getYearLabel() ?: 'Year not set') ?></p>
                <p class="id-number"><?= htmlspecialchars($student->getStudentId()) ?></p>
            </div>
        </div>

        <div class="id-card-barcode">
            <svg id="barcode"></svg>
        </div>
    </div>

    <p class="no-print">
        <button type="button" onclick="window.print()">Print ID</button>
        <a class="btn-small" href="<?= BASE_URL ?>/index.php?page=edit&id=<?= urlencode($student->getStudentId()) ?>">Edit student</a>
        <a class="btn-small" href="<?= BASE_URL ?>/index.php?page=students">Back to list</a>
    </p>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.6/JsBarcode.all.min.js"></script>
    <script>
        JsBarcode("#barcode", <?= json_encode($student->getStudentId()) ?>, {
            format: "CODE128",
            displayValue: false,
            height: 26,
            width: 1.2,
            margin: 0
        });
    </script>

<?php endif; ?>