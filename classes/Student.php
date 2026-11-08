<?php

// Student is a Person, so it inherits firstname, lastname and completeName()
class Student extends Person
{
    // The choices shown in the form dropdowns
    public const COURSES = [
        'BS in Information Systems',
        'BS in Education',
        'BS in Business Administration'
    ];

    public const YEAR_LEVELS = ['1st Year', '2nd Year', '3rd Year', '4th Year'];

    public string $id_number;
    protected string $dob;
    protected string $course;
    protected string $year_level;
    protected string $middle_initial;

    public function __construct(
        string $id_number,
        string $firstname,
        string $lastname,
        string $dob,
        string $course,
        string $year_level,
        string $middle_initial = ''
    ) {
        $this->id_number = $id_number;
        $this->dob = $dob;
        $this->course = $course;
        $this->year_level = $year_level;
        $this->middle_initial = $middle_initial;
        parent::__construct($firstname, $lastname); // sets the Person part
    }

    public function getIdNumber(): string
    {
        return $this->id_number;
    }

    public function dateOfBirth(): string
    {
        return date('F d Y', strtotime($this->dob));
    }

    public function getCourse(): string
    {
        return $this->course;
    }

    public function getYearLevel(): string
    {
        return $this->year_level;
    }

    // Name as shown on the ID card: "Sandara P. Pilas" (First MI Last)
    public function idCardName(): string
    {
        $mi = $this->middle_initial !== '' ? ' ' . $this->middle_initial . '.' : '';
        return $this->firstname . $mi . ' ' . $this->lastname;
    }

    // Builds a Student from one row of the database
    public static function fromArray(array $s): Student
    {
        return new Student(
            $s['student_number'],
            $s['firstname'],
            $s['lastname'],
            $s['date_of_birth'],
            $s['course'],
            $s['year_level'],
            $s['middle_initial']
        );
    }

    // Checks the form data. Returns an error message, or '' if everything is fine.
    public static function validate(array $d): string
    {
        foreach (['student_number', 'firstname', 'lastname', 'date_of_birth', 'course', 'year_level'] as $field) {
            if ($d[$field] === '') {
                return 'Please fill in all required fields.';
            }
        }
        if ($d['middle_initial'] !== '' && !preg_match('/^[A-Z]$/', $d['middle_initial'])) {
            return 'Middle initial must be one letter.';
        }
        if (strtotime($d['date_of_birth']) === false) {
            return 'Please enter a valid date of birth.';
        }
        if (!in_array($d['course'], self::COURSES, true)) {
            return 'Please choose a valid course.';
        }
        if (!in_array($d['year_level'], self::YEAR_LEVELS, true)) {
            return 'Please choose a valid year level.';
        }
        return '';
    }
}