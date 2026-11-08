<?php
$error = '';

// Empty form when the page first opens
$formData = [
    'student_number' => '',
    'firstname'      => '',
    'middle_initial' => '',
    'lastname'       => '',
    'date_of_birth'  => '',
    'course'         => '',
    'year_level'     => ''
];

// The form was submitted (Save button clicked)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = [
        'student_number' => trim($_POST['student_number'] ?? ''),
        'firstname'      => trim($_POST['firstname'] ?? ''),
        'middle_initial' => strtoupper(trim($_POST['middle_initial'] ?? '')),
        'lastname'       => trim($_POST['lastname'] ?? ''),
        'date_of_birth'  => trim($_POST['date_of_birth'] ?? ''),
        'course'         => trim($_POST['course'] ?? ''),
        'year_level'     => trim($_POST['year_level'] ?? '')
    ];

    $error = Student::validate($formData); // empty text means no problem

    if ($error === '') {
        try {
            StudentRepository::create($formData);
            header('Location: index.php?page=students&msg=added'); // go back to the table
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
    <h2>Add Student</h2>

    <?php if ($error !== '') : ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php
    $buttonText = 'Save';
    include 'components/student_form.php';
    ?>
</main>