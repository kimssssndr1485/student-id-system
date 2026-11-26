<?php
$error = '';
$formData = Validator::cleanStudent([]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = Validator::cleanStudent($_POST);
    $error = Validator::validateStudent($formData);

    if ($error === '') {
        if (StudentRepository::create($formData)) {
            header('Location: index.php?page=students&msg=added');
            exit;
        }
        $error = 'That ID number already exists.';
    }
}
?>
<main class="content">
    <h2>Add Student</h2>
    <?php if ($error !== '') : ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php
    $buttonText = 'Save';
    include 'components/student_form.php';
    ?>
</main>