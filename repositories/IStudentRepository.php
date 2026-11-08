<?php
interface IStudentRepository
{
    public static function all(): array;

    public static function find(string $id): array;

    public static function create(array $data): void;

    public static function update(array $data): array;

    public static function delete(string $id): void;
}