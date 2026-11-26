<?php
class Page
{
    private const ROUTES = [
        'dashboard' => 'modules/dashboard.php',
        'students'  => 'modules/student_display.php',
        'add'       => 'modules/student_add.php',
        'edit'      => 'modules/student_edit.php',
        'search'    => 'modules/student_search.php',
        'idcard'    => 'modules/id_card.php',
    ];

    public static function display(string $page): void
    {
        if (isset(self::ROUTES[$page])) {
            include self::ROUTES[$page];
        } else {
            include 'modules/dashboard.php';
        }
    }
}