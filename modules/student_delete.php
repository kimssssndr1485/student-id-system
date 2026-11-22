<?php include '../config/config.php'; ?>
<?php include '../classes/Auth.php'; ?>
<?php include '../classes/Person.php'; ?>
<?php include '../classes/Student.php'; ?>

<?php include '../repositories/IStudentRepository.php'; ?>
<?php include '../repositories/DBRepository.php'; ?>
<?php include '../repositories/StudentRepository.php'; ?>

<?php
// Only a logged-in user can delete
if (!Auth::check()) {
    header('Location: ../login.php');
    exit;
}

$id = $_GET['id'] ?? '';
StudentRepository::delete($id);

header('Location: ../index.php?page=students&msg=deleted');