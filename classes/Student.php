<?php
class Student extends Person
{
    public const YEAR_LEVELS = ['1st Year', '2nd Year', '3rd Year', '4th Year'];
    public const ID_STATUSES = ['Unclaimed', 'Released'];

    public function __construct(
        private string $id_number,
        string $firstname,
        string $lastname,
        private string $dob,
        private int $course_id,
        private string $year_level,
        private string $middle_initial = '',
        private string $course_name = '',
        private string $id_status = 'Unclaimed'
    ) {
        parent::__construct($firstname, $lastname);
    }

    public function roleLabel(): string { return 'Student - ' . $this->year_level; }
    public function getIdNumber(): string { return $this->id_number; }
    public function getMiddleInitial(): string { return $this->middle_initial; }
    public function dateOfBirth(): string { return date('F d, Y', strtotime($this->dob)); }
    public function getCourse(): string { return $this->course_name; }
    public function getYearLevel(): string { return $this->year_level; }
    public function getIdStatus(): string { return $this->id_status; }

    public function idCardName(): string
    {
        $mi = $this->middle_initial !== '' ? ' ' . $this->middle_initial . '.' : '';
        return $this->firstname . $mi . ' ' . $this->lastname;
    }

    public static function fromArray(array $s): Student
    {
        return new Student(
            $s['student_number'],
            $s['firstname'],
            $s['lastname'],
            $s['date_of_birth'],
            (int) $s['course_id'],
            $s['year_level'],
            $s['middle_initial'] ?? '',
            $s['course_name'] ?? '',
            $s['id_status'] ?? 'Unclaimed'
        );
    }
}