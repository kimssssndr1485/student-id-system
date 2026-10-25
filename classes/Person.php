<?php
class Person
{
    // protected: this class and its child classes (like Student) can use them
    protected string $firstname;
    protected string $lastname;

    public function __construct(string $firstname, string $lastname)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    // Example result: "Pilas, Sandara"
    public function completeName(): string {
        return $this->lastname .", ". $this->firstname;
    }
}