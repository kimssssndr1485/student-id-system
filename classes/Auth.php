<?php
// Developer-only admin credentials (default password: password)
class Auth
{
    private const USERNAME = 'admin';
    private const PASSWORD_HASH = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

    private static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function login(string $user, string $pass): bool
    {
        self::start();
        if ($user === self::USERNAME && password_verify($pass, self::PASSWORD_HASH)) {
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