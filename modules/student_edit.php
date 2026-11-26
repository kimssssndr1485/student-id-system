<?php
$found = StudentRepository::find($_GET['id'] ?? '');
$formData = $found;
?>
<main class="content">
    <h2>Edit Student</h2>
    <?php if (empty($found)) : ?>
        <p>Student not found.</p>
        <a href="index.php?page=students" class="btn btn-secondary">Back to Students</a>
    <?php else : ?>
        <?php
        $buttonText = 'Update';
        $formAction = 'modules/student_update.php?id=' . $found['student_number'];
        include 'components/student_form.php';
        ?>
    <?php endif; ?>
</main>