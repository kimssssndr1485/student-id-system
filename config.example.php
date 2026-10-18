<?php
// ---------- Settings for the whole system ----------

// Name of your folder inside htdocs. Must match exactly.
define('BASE_URL', '/student-id-system');
define('BASE_PATH', __DIR__);

// The single faculty account (like a router login).
define('ADMIN_USERNAME', 'admin');

// Hashed password. This hash means the password is:  password
// To make your own, run in the terminal:
//   php -r "echo password_hash('your-new-password', PASSWORD_DEFAULT);"
// then paste the result below.
define('ADMIN_PASSWORD_HASH', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
