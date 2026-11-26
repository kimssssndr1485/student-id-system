<?php
class CourseRepository extends DBRepository implements ICourseRepository
{
    public static function getCourses(): array
    {
        $res = self::connect()->query('SELECT id, name FROM courses ORDER BY name ASC');
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function countByCourse(): array
    {
        $sql = 'SELECT c.name, COUNT(s.id) AS total
                FROM courses c
                LEFT JOIN students s ON s.course_id = c.id
                GROUP BY c.id, c.name
                ORDER BY c.name ASC';
        $res = self::connect()->query($sql);
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    }
}