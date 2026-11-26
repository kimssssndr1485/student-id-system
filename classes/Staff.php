<?php
class Staff extends Person
{
    private string $position;

    public function __construct(string $firstname, string $lastname, string $position = 'Registrar')
    {
        $this->position = $position;
        parent::__construct($firstname, $lastname);
    }

    public function roleLabel(): string
    {
        return 'Authorized School ' . $this->position;
    }
}