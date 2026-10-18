<?php
require_once __DIR__ . '/Person.php';

// Child class: a Person who also has an ID, course, year level and photo.
class Student extends Person
{
    // Edit this list to change the courses shown in the forms.
    public const COURSES = [
        'BS in Information Systems',
        'BS in Education',
        'BS in Business Administration',
    ];

    public const YEAR_LEVELS = [
        1 => '1st Year',
        2 => '2nd Year',
        3 => '3rd Year',
        4 => '4th Year',
    ];

    private string $studentId;
    private string $course;
    private int $yearLevel;
    private string $photo;

    public function __construct(
        string $firstName,
        string $lastName,
        string $studentId,
        string $middleInitial = '',
        string $course = '',
        int $yearLevel = 0,
        string $photo = ''
    ) {
        parent::__construct($firstName, $lastName, $middleInitial);
        $this->studentId = $studentId;
        $this->course    = $course;
        $this->yearLevel = $yearLevel;
        $this->photo     = $photo;
    }

    public function getStudentId(): string
    {
        return $this->studentId;
    }

    public function getCourse(): string
    {
        return $this->course;
    }

    public function getYearLevel(): int
    {
        return $this->yearLevel;
    }

    public function getYearLabel(): string
    {
        return self::YEAR_LEVELS[$this->yearLevel] ?? '';
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    // Turn the object into an array so it can be saved as JSON.
    public function toArray(): array
    {
        return [
            'studentId'     => $this->studentId,
            'firstName'     => $this->firstName,
            'middleInitial' => $this->middleInitial,
            'lastName'      => $this->lastName,
            'course'        => $this->course,
            'yearLevel'     => $this->yearLevel,
            'photo'         => $this->photo,
        ];
    }

    // Build a Student object from a saved array (old records without the new fields still work).
    public static function fromArray(array $row): Student
    {
        return new Student(
            $row['firstName'],
            $row['lastName'],
            $row['studentId'],
            $row['middleInitial'] ?? '',
            $row['course'] ?? '',
            (int) ($row['yearLevel'] ?? 0),
            $row['photo'] ?? ''
        );
    }
}