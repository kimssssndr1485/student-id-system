<?php
$found = StudentRepository::find($_GET['id'] ?? '');
$error = '';
$formData = $found; // the form starts filled with the current data

// The form was submitted (Update button clicked)
if (!empty($found) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = [
        'id'             => $found['id'], // which row to update
        'student_number' => trim($_POST['student_number'] ?? ''),
        'firstname'      => trim($_POST['firstname'] ?? ''),
        'middle_initial' => strtoupper(trim($_POST['middle_initial'] ?? '')),
        'lastname'       => trim($_POST['lastname'] ?? ''),
        'date_of_birth'  => trim($_POST['date_of_birth'] ?? ''),
        'course'         => trim($_POST['course'] ?? ''),
        'year_level'     => trim($_POST['year_level'] ?? '')
    ];

    $error = Student::validate($formData);

    if ($error === '') {
        try {
            StudentRepository::update($formData);
            header('Location: index.php?page=students&msg=updated'); // go back to the table
            exit;
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $error = 'That ID number already exists.';
            } else {
                throw $e;
            }
        }
    }
}
?>
<main class="content">
    <h2>Edit Student</h2>

    <?php if (empty($found)) : ?>

        <p>Student not found.</p>
        <a href="index.php?page=students" class="btn btn-secondary">Back to Students</a>

    <?php else : ?>

        <?php if ($error !== '') : ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php
        $buttonText = 'Update';
        include 'components/student_form.php';
        ?>

    <?php endif; ?>
</main>