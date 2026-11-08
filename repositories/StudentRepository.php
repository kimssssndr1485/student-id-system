<?php

class StudentRepository extends DBRepository implements IStudentRepository
{
    // Returns a list of Student objects from the database
    public static function all(): array
    {
        $stmt = self::connect()->query('SELECT * FROM students ORDER BY student_number');

        $result = [];

        foreach ($stmt->fetchAll() as $s) {
            $result[] = Student::fromArray($s);
        }
        return $result;
    }

    // Returns the data of ONE student (by student number), or an empty array if not found
    public static function find(string $id): array
    {
        $stmt = self::connect()->prepare('SELECT * FROM students WHERE student_number = :id');
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        return $row ?: [];
    }

    // ADD: saves a new student in the database
    public static function create(array $data): void
    {
        $sql = 'INSERT INTO students
                    (student_number, firstname, middle_initial, lastname, date_of_birth, course, year_level)
                VALUES
                    (:student_number, :firstname, :middle_initial, :lastname, :date_of_birth, :course, :year_level)';

        $stmt = self::connect()->prepare($sql);
        $stmt->execute([
            'student_number' => $data['student_number'],
            'firstname'      => $data['firstname'],
            'middle_initial' => $data['middle_initial'],
            'lastname'       => $data['lastname'],
            'date_of_birth'  => $data['date_of_birth'],
            'course'         => $data['course'],
            'year_level'     => $data['year_level']
        ]);
    }

    // EDIT: changes an existing student, then returns the updated data
    public static function update(array $data): array
    {
        $sql = 'UPDATE students SET
                    student_number = :student_number,
                    firstname      = :firstname,
                    middle_initial = :middle_initial,
                    lastname       = :lastname,
                    date_of_birth  = :date_of_birth,
                    course         = :course,
                    year_level     = :year_level
                WHERE id = :id';

        $stmt = self::connect()->prepare($sql);
        $stmt->execute([
            'student_number' => $data['student_number'],
            'firstname'      => $data['firstname'],
            'middle_initial' => $data['middle_initial'],
            'lastname'       => $data['lastname'],
            'date_of_birth'  => $data['date_of_birth'],
            'course'         => $data['course'],
            'year_level'     => $data['year_level'],
            'id'             => $data['id']
        ]);

        return self::find($data['student_number']);
    }

    // To be added in the next lessons
    public static function delete(string $id): void {}
}