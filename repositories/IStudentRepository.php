<?php
// An interface is a list of methods that any student repository MUST have.
// It has no code inside, only the rules.
interface IStudentRepository
{
    public static function all(): array;

    public static function find(string $id): array;

    public static function update(array $data): array;

    public static function delete(string $id): void;
}