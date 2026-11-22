<?php include '../config/config.php'; ?>
<?php include '../classes/Auth.php'; ?>
<?php include '../classes/Person.php'; ?>
<?php include '../classes/Student.php'; ?>

<?php include '../repositories/IStudentRepository.php'; ?>
<?php include '../repositories/DBRepository.php'; ?>
<?php include '../repositories/StudentRepository.php'; ?>

<?php
// Only a logged-in user, and only from the form (not by typing the address)
if (!Auth::check() || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php?page=students');
    exit;
}

    $id             = $_GET['id'];
    $student_number = $_POST['student_number'];
    $firstname      = $_POST['firstname'];
    $middle_initial = $_POST['middle_initial'];
    $lastname       = $_POST['lastname'];
    $date_of_birth  = $_POST['date_of_birth'];
    $course         = $_POST['course'];
    $year_level     = $_POST['year_level'];

StudentRepository::update([
    'student_number' => $student_number,
    'firstname'      => $firstname,
    'middle_initial' => $middle_initial,
    'lastname'       => $lastname,
    'date_of_birth'  => $date_of_birth,
    'course'         => $course,
    'year_level'     => $year_level,
], $id);

header('Location: ../index.php?page=students&msg=updated');