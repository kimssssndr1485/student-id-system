<?php

// Student is a Person, so it inherits firstname, lastname and completeName()
class Student extends Person
{
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

    // Builds a Student from one row of the array in StudentRepository
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
}