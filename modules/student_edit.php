<?php
defined('APP_RUNNING') or die('Access denied');
require_once BASE_PATH . '/classes/StudentList.php';
require_once BASE_PATH . '/classes/PhotoUploader.php';

$list     = new StudentList();
$uploader = new PhotoUploader();
$id       = $_GET['id'] ?? '';
$student  = $list->find($id);
$error    = '';

if ($student === null) {
    echo '<h2>Edit Student</h2>';
    echo '<p>Student not found. <a href="' . BASE_URL . '/index.php?page=students">Go to the student list</a>.</p>';
    return;
}

$old = [
    'first_name'     => $student->getFirstName(),
    'middle_initial' => $student->getMiddleInitial(),
    'last_name'      => $student->getLastName(),
    'course'         => $student->getCourse(),
    'year_level'     => (string) $student->getYearLevel(),
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = array_merge($old, array_map('trim', array_intersect_key($_POST, $old)));

    $first  = $old['first_name'];
    $mi     = strtoupper($old['middle_initial']);
    $last   = $old['last_name'];
    $course = $old['course'];
    $year   = (int) $old['year_level'];

    if ($first === '' || $last === '') {
        $error = 'Please enter both first name and last name.';
    } elseif ($mi !== '' && !preg_match('/^[A-Z]$/', $mi)) {
        $error = 'Middle initial must be a single letter.';
    } elseif (!in_array($course, Student::COURSES, true)) {
        $error = 'Please choose a course.';
    } elseif (!isset(Student::YEAR_LEVELS[$year])) {
        $error = 'Please choose a year level.';
    } else {
        try {
            // Keep the old photo unless a new one is chosen.
            $photo   = $uploader->upload($_FILES['photo'] ?? [], $id) ?? $student->getPhoto();
            $updated = new Student($first, $last, $id, $mi, $course, $year, $photo);
            $list->update($updated);
            header('Location: ' . BASE_URL . '/index.php?page=students&updated=' . urlencode($id));
            exit;
        } catch (RuntimeException $e) {
            $error = $e->getMessage();
        }
    }
}

// Current photo (if any) for the preview.
$photoUrl = '';
if ($student->getPhoto() !== '') {
    $file = BASE_PATH . '/assets/uploads/photos/' . $student->getPhoto();
    if (file_exists($file)) {
        $photoUrl = BASE_URL . '/assets/uploads/photos/' . rawurlencode($student->getPhoto()) . '?v=' . filemtime($file);
    }
}
?>
<h2>Edit Student <?= htmlspecialchars($id) ?></h2>

<?php if ($error !== ''): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST" action="" class="simple-form" enctype="multipart/form-data">
    <label for="first_name">First name</label>
    <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($old['first_name']) ?>" required>

    <label for="middle_initial">Middle initial</label>
    <input type="text" id="middle_initial" name="middle_initial" maxlength="1" value="<?= htmlspecialchars($old['middle_initial']) ?>">

    <label for="last_name">Last name</label>
    <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($old['last_name']) ?>" required>

    <label for="year_level">Year level</label>
    <select id="year_level" name="year_level" required>
        <option value="">-- Choose year --</option>
        <?php foreach (Student::YEAR_LEVELS as $num => $label): ?>
            <option value="<?= $num ?>" <?= (int) $old['year_level'] === $num ? 'selected' : '' ?>><?= $label ?></option>
        <?php endforeach; ?>
    </select>

    <label for="course">Course</label>
    <select id="course" name="course" required>
        <option value="">-- Choose course --</option>
        <?php foreach (Student::COURSES as $c): ?>
            <option value="<?= htmlspecialchars($c) ?>" <?= $old['course'] === $c ? 'selected' : '' ?>><?= htmlspecialchars($c) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="photo">Photo (passport size, JPG or PNG)</label>
    <?php if ($photoUrl !== ''): ?>
        <img src="<?= $photoUrl ?>" alt="Current photo" class="photo-preview">
        <p class="hint">Choose a new file only if you want to replace this photo.</p>
    <?php endif; ?>
    <input type="file" id="photo" name="photo" accept="image/jpeg,image/png">

    <button type="submit">Save Changes</button>
</form>