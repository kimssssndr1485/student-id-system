<?php
class Page
{
    // Shows the module (page) that matches the name in the address,
    // for example index.php?page=students
    public static function display(string $page)
    {
        switch ($page) {
            case 'students':
                include 'modules/student_display.php';
                break;
            case 'idcard':
                include 'modules/id_card.php';
                break;
            default:
                include 'modules/dashboard.php';
        }
    }
}