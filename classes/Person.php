<?php
// Parent class: what every person in the system has.
class Person
{
    protected string $firstName;
    protected string $middleInitial;
    protected string $lastName;

    public function __construct(string $firstName, string $lastName, string $middleInitial = '')
    {
        $this->firstName     = $firstName;
        $this->lastName      = $lastName;
        $this->middleInitial = $middleInitial;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getMiddleInitial(): string
    {
        return $this->middleInitial;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    // Example: "Sandara P. Pilas" (or "Sandara Pilas" if there is no middle initial)
    public function getFullName(): string
    {
        $mi = $this->middleInitial !== '' ? ' ' . $this->middleInitial . '.' : '';
        return $this->firstName . $mi . ' ' . $this->lastName;
    }
}