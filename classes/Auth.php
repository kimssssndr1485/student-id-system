<?php
class Auth
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login(string $username, string $password): bool
    {
        if ($username === ADMIN_USERNAME && password_verify($password, ADMIN_PASSWORD_HASH)) {
            session_regenerate_id(true);
            $_SESSION['logged_in'] = true;
            $_SESSION['username']  = $username;
            return true;
        }
        return false;
    }

    public function isLoggedIn(): bool
    {
        return !empty($_SESSION['logged_in']);
    }

    // Put this at the top of any page that needs a login.
    public function requireLogin(): void
    {
        if (!$this->isLoggedIn()) {
            header('Location: ' . BASE_URL . '/login.php');
            exit;
        }
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
    }
}
