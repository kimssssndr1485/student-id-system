<?php
include '../config/config.php';
include '../classes/Auth.php';
include '../classes/Person.php';
include '../classes/Student.php';
include '../classes/Validator.php';
include '../repositories/IStudentRepository.php';
include '../repositories/DBRepository.php';
include '../repositories/StudentRepository.php';

if (!Auth::check() || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php?page=students');
    exit;
}

$id = $_GET['id'] ?? '';
$data = Validator::cleanStudent($_POST);
$error = Validator::validateStudent($data);

if ($error !== '') {
    die($error . ' <a href="../index.php?page=edit&id=' . htmlspecialchars($id) . '">Go Back</a>');
}

if (StudentRepository::update($data, $id)) {
    header('Location: ../index.php?page=students&msg=updated');
    exit;
}
die('That ID number already exists. <a href="../index.php?page=edit&id=' . htmlspecialchars($id) . '">Go Back</a>');