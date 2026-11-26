<?php
include '../config/config.php';
include '../classes/Auth.php';
include '../classes/Person.php';
include '../classes/Student.php';
include '../repositories/IStudentRepository.php';
include '../repositories/DBRepository.php';
include '../repositories/StudentRepository.php';

if (!Auth::check()) {
    header('Location: ../login.php');
    exit;
}

$id = $_GET['id'] ?? '';
$status = $_GET['status'] ?? '';

if ($id !== '' && in_array($status, Student::ID_STATUSES, true)) {
    StudentRepository::updateStatus($id, $status);
}

header('Location: ../index.php?page=students&msg=status');
exit;