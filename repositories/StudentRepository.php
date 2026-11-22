<?php

class StudentRepository extends DBRepository implements IStudentRepository
{
    // Returns a list of Student objects from the database
    public static function all(): array
    {
        $stmt = self::connect()->query('SELECT * FROM students ORDER BY student_number');
//prepackages and safety locked SQL

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

        // $data has the same keys as the :placeholders above
        self::connect()->prepare($sql)->execute($data);
    }

    // EDIT: changes the student whose student number is $id, then returns the updated data
    public static function update(array $data, string $id): array
    {
        $sql = 'UPDATE students SET
                    student_number = :student_number, firstname = :firstname,
                    middle_initial = :middle_initial, lastname = :lastname,
                    date_of_birth = :date_of_birth, course = :course, year_level = :year_level
                WHERE student_number = :id';

        $data['id'] = $id;
        self::connect()->prepare($sql)->execute($data);
        return self::find($data['student_number']);
    }

    // DELETE: removes the student with this student number
    public static function delete(string $id): void
    {
        $stmt = self::connect()->prepare('DELETE FROM students WHERE student_number = :id');
        $stmt->execute(['id' => $id]);

        //:: go directly inside a class
    }
}