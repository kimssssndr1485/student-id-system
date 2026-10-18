<?php
require_once __DIR__ . '/Student.php';

// Holds all students. The array key is the student ID, so finding
// a student by ID is fast and two students can never share an ID.
class StudentList
{
    private string $file;
    private array $students = []; // [ '2026-0001' => Student, ... ]

    public function __construct(?string $file = null)
    {
        $this->file = $file ?? __DIR__ . '/../data/students.json';
        $this->load();
    }

    private function load(): void
    {
        if (!file_exists($this->file)) {
            return;
        }
        $data = json_decode(file_get_contents($this->file), true);
        if (!is_array($data)) {
            return;
        }
        foreach ($data as $row) {
            $student = Student::fromArray($row);
            $this->students[$student->getStudentId()] = $student;
        }
    }

    private function save(): void
    {
        $rows = [];
        foreach ($this->students as $student) {
            $rows[] = $student->toArray();
        }
        file_put_contents($this->file, json_encode($rows, JSON_PRETTY_PRINT), LOCK_EX);
    }

    public function exists(string $id): bool
    {
        return isset($this->students[$id]);
    }

    public function find(string $id): ?Student
    {
        return $this->students[$id] ?? null;
    }

    public function add(Student $student): bool
    {
        if ($this->exists($student->getStudentId())) {
            return false; // duplicate ID, not added
        }
        $this->students[$student->getStudentId()] = $student;
        $this->save();
        return true;
    }

    // Replace an existing student's details (used by the Edit page).
    public function update(Student $student): bool
    {
        if (!$this->exists($student->getStudentId())) {
            return false;
        }
        $this->students[$student->getStudentId()] = $student;
        $this->save();
        return true;
    }

    public function all(): array
    {
        return array_values($this->students);
    }

    public function count(): int
    {
        return count($this->students);
    }

    // Makes the next ID in the format YEAR-0001, YEAR-0002, ...
    public function generateId(?int $year = null): string
    {
        $year = $year ?? (int) date('Y');
        $max  = 0;
        foreach (array_keys($this->students) as $id) {
            if (strpos($id, $year . '-') === 0) {
                $number = (int) substr($id, strlen($year) + 1);
                if ($number > $max) {
                    $max = $number;
                }
            }
        }
        return sprintf('%d-%04d', $year, $max + 1);
    }
}