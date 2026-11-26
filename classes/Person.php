<?php
abstract class Person
{
    protected string $firstname;
    protected string $lastname;

    public function __construct(string $firstname, string $lastname)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    // Concrete method reused by child classes
    public function completeName(): string
    {
        return $this->lastname . ', ' . $this->firstname;
    }

    // Abstract method implemented by each child class
    abstract public function roleLabel(): string;
}