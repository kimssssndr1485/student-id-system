<?php
class StudentRepository extends DBRepository implements IStudentRepository
{
    private static function mapRows(mysqli_result|bool $res): array
    {
        $list = [];
        while ($res && ($row = $res->fetch_assoc())) {
            $list[] = Student::fromArray($row);
        }
        return $list;
    }

    public static function all(): array
    {
        $sql = 'SELECT s.*, c.name AS course_name FROM students s
                INNER JOIN courses c ON s.course_id = c.id
                ORDER BY s.created_at DESC, s.id DESC';
        return self::mapRows(self::connect()->query($sql));
    }

    public static function search(string $q): array
    {
        $like = '%' . $q . '%';
        $stmt = self::connect()->prepare(
            'SELECT s.*, c.name AS course_name FROM students s
             INNER JOIN courses c ON s.course_id = c.id
             WHERE s.student_number LIKE ? OR s.firstname LIKE ? OR s.lastname LIKE ? OR c.name LIKE ?
             ORDER BY s.created_at DESC, s.id DESC'
        );
        $stmt->bind_param('ssss', $like, $like, $like, $like);
        $stmt->execute();
        return self::mapRows($stmt->get_result());
    }

    public static function find(string $id): array
    {
        $stmt = self::connect()->prepare(
            'SELECT s.*, c.name AS course_name FROM students s
             INNER JOIN courses c ON s.course_id = c.id WHERE s.student_number = ?'
        );
        $stmt->bind_param('s', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc() ?: [];
    }

    public static function create(array $d): bool
    {
        $stmt = self::connect()->prepare(
            'INSERT INTO students (student_number, firstname, middle_initial, lastname, date_of_birth, course_id, year_level, id_status)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
        );
        $cid = (int) $d['course_id'];
        $stmt->bind_param('sssssiss', $d['student_number'], $d['firstname'], $d['middle_initial'], $d['lastname'], $d['date_of_birth'], $cid, $d['year_level'], $d['id_status']);
        return $stmt->execute();
    }

    public static function update(array $d, string $id): bool
    {
        $stmt = self::connect()->prepare(
            'UPDATE students SET student_number=?, firstname=?, middle_initial=?, lastname=?, date_of_birth=?, course_id=?, year_level=?, id_status=? WHERE student_number=?'
        );
        $cid = (int) $d['course_id'];
        $stmt->bind_param('sssssisss', $d['student_number'], $d['firstname'], $d['middle_initial'], $d['lastname'], $d['date_of_birth'], $cid, $d['year_level'], $d['id_status'], $id);
        return $stmt->execute();
    }

    public static function updateStatus(string $id, string $status): void
    {
        $stmt = self::connect()->prepare('UPDATE students SET id_status = ? WHERE student_number = ?');
        $stmt->bind_param('ss', $status, $id);
        $stmt->execute();
    }

    public static function delete(string $id): void
    {
        $stmt = self::connect()->prepare('DELETE FROM students WHERE student_number = ?');
        $stmt->bind_param('s', $id);
        $stmt->execute();
    }

    public static function countByStatus(string $status): int
    {
        $stmt = self::connect()->prepare('SELECT COUNT(*) AS total FROM students WHERE id_status = ?');
        $stmt->bind_param('s', $status);
        $stmt->execute();
        return (int) ($stmt->get_result()->fetch_assoc()['total'] ?? 0);
    }
}