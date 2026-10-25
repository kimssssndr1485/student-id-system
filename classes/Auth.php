<?php
// Handles the faculty login (one username and one password, like a router)
class Auth
{
    private const USERNAME = 'admin';

    // This hash means the password is: password
    // To make your own, run: php -r "echo password_hash('new-password', PASSWORD_DEFAULT);"
    private const PASSWORD_HASH = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
    //A password hash is a one-way mathematical transformation that turns a plaintext password into a fixed-length string of scrambled characters

    private static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function login(string $username, string $password): bool
    {
        self::start();
        if ($username === self::USERNAME && password_verify($password, self::PASSWORD_HASH)) {
            session_regenerate_id(true);
            $_SESSION['logged_in'] = true;
            return true;
        }
        return false;
    }

    public static function check(): bool
    {
        self::start();
        return !empty($_SESSION['logged_in']);
    }

    // Put at the top of a page: if not logged in, go to the login page
    public static function requireLogin(): void
    {
        if (!self::check()) {
            header('Location: login.php');
            exit;
        }
    }

    public static function username(): string
    {
        return self::USERNAME;
    }

    public static function logout(): void
    {
        self::start();
        $_SESSION = [];
        session_destroy();
    }
}