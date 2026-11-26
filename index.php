<?php
ob_start();
include 'config/config.php';
include 'classes/Auth.php';
Auth::requireLogin();

include 'classes/Page.php';
include 'classes/Person.php';
include 'classes/Student.php';
include 'classes/Staff.php';
include 'classes/Validator.php';
include 'repositories/IStudentRepository.php';
include 'repositories/ICourseRepository.php';
include 'repositories/DBRepository.php';
include 'repositories/StudentRepository.php';
include 'repositories/CourseRepository.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'components/head.php'; ?>
<body>
    <?php include 'components/navbar.php'; ?>
    <div class="layout">
        <?php include 'components/sidebar.php'; ?>
        <?php Page::display($_GET['page'] ?? 'dashboard'); ?>
    </div>
</body>
</html>