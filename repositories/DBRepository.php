<?php
class DBRepository
{
    private static ?mysqli $conn = null;

    protected static function connect(): mysqli
    {
        if (self::$conn === null) {
            mysqli_report(MYSQLI_REPORT_OFF);
            self::$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (self::$conn->connect_error) {
                die('Database connection failed: ' . self::$conn->connect_error);
            }
            self::$conn->set_charset('utf8mb4');
            self::ensureSchema(self::$conn);
        }
        return self::$conn;
    }

    private static function ensureSchema(mysqli $db): void
    {
        $db->query("CREATE TABLE IF NOT EXISTS courses (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL UNIQUE
        ) ENGINE=InnoDB");
        $db->query("INSERT IGNORE INTO courses (name) VALUES
            ('BS in Information Systems'), ('BS in Education'), ('BS in Business Administration')");

        $cols = [
            'created_at' => 'ADD COLUMN created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'id_status'  => "ADD COLUMN id_status VARCHAR(20) NOT NULL DEFAULT 'Unclaimed'",
            'course_id'  => 'ADD COLUMN course_id INT NOT NULL DEFAULT 1',
        ];
        foreach ($cols as $name => $alter) {
            $res = $db->query("SHOW COLUMNS FROM students LIKE '$name'");
            if ($res && $res->num_rows === 0) {
                $db->query("ALTER TABLE students $alter");
            }
        }
    }
}