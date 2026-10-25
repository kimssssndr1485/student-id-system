<?php

// extends = inherits from DBRepository
// implements = promises to have all the methods of IStudentRepository
class StudentRepository extends DBRepository implements IStudentRepository
{
    // Our sample data (later this will come from a database).
    // The dates, courses and years are samples. Change them to the real ones.
    private static function data(): array
    {
        return [
            [
                'id' => 1,
                'student_number' => '2026-0001',
                'firstname' => 'Sandara',
                'middle_initial' => '',
                'lastname' => 'Pilas',
                'date_of_birth' => '2005-01-01',
                'course' => 'BS in Information Systems',
                'year_level' => '2nd Year'
            ],
            [
                'id' => 2,
                'student_number' => '2026-0002',
                'firstname' => 'Mabrick',
                'middle_initial' => '',
                'lastname' => 'Teompa',
                'date_of_birth' => '2005-01-01',
                'course' => 'BS in Information Systems',
                'year_level' => '2nd Year'
            ],
            [
                'id' => 3,
                'student_number' => '2026-0003',
                'firstname' => 'Hershie',
                'middle_initial' => '',
                'lastname' => 'Balza',
                'date_of_birth' => '2005-01-01',
                'course' => 'BS in Information Systems',
                'year_level' => '2nd Year'
            ],
            [
                'id' => 4,
                'student_number' => '2026-0004',
                'firstname' => 'Alyssa',
                'middle_initial' => '',
                'lastname' => 'Diocson',
                'date_of_birth' => '2005-01-01',
                'course' => 'BS in Information Systems',
                'year_level' => '2nd Year'
            ],
            [
                'id' => 5,
                'student_number' => '2026-0005',
                'firstname' => 'Jexy',
                'middle_initial' => '',
                'lastname' => 'Viva',
                'date_of_birth' => '2005-01-01',
                'course' => 'BS in Information Systems',
                'year_level' => '2nd Year'
            ]
        ];
    }

    // Returns a list of Student objects
    public static function all(): array
    {
        $result = [];

        foreach (self::data() as $s) {
            $result[] = Student::fromArray($s);
        }
        return $result;
    }

    // Returns the data of ONE student (by student number), or an empty array if not found
    public static function find(string $id): array
    {
        foreach (self::data() as $s) {
            if ($s['student_number'] === $id) {
                return $s;
            }
        }
        return [];
    }

    // To be added in the next lessons
    public static function update(array $data): array
    {
        return [];
    }

    // To be added in the next lessons
    public static function delete(string $id): void {}
}