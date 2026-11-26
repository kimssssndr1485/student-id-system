<?php
include '../config/config.php';
include '../classes/Auth.php';
include '../classes/Person.php';
include '../classes/Student.php';
include '../repositories/IStudentRepository.php';
include '../repositories/ICourseRepository.php';
include '../repositories/DBRepository.php';
include '../repositories/StudentRepository.php';

if (!Auth::check()) {
    header('Location: ../login.php');
    exit;
}

$id = trim($_GET['id'] ?? '');
if ($id !== '') {
    StudentRepository::delete($id);
}

header('Location: ../index.php?page=students&msg=deleted');
exit;