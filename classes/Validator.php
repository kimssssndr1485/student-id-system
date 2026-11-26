<?php
class Validator
{
    public static function cleanStudent(array $post): array
    {
        return [
            'student_number' => trim($post['student_number'] ?? ''),
            'firstname'      => trim($post['firstname'] ?? ''),
            'middle_initial' => strtoupper(trim($post['middle_initial'] ?? '')),
            'lastname'       => trim($post['lastname'] ?? ''),
            'date_of_birth'  => trim($post['date_of_birth'] ?? ''),
            'course_id'      => trim($post['course_id'] ?? ''),
            'year_level'     => trim($post['year_level'] ?? ''),
            'id_status'      => trim($post['id_status'] ?? 'Unclaimed'),
        ];
    }

    public static function validateStudent(array $d): string
    {
        if (
            $d['student_number'] === '' || $d['firstname'] === '' ||
            $d['lastname'] === '' || $d['date_of_birth'] === '' ||
            $d['course_id'] === '' || $d['year_level'] === ''
        ) {
            return 'Please fill in all required fields.';
        }

        if (!preg_match('/^\d{2}-\d{4}$/', $d['student_number'])) {
            return 'Student number must be in 00-0000 format (example: 26-0001).';
        }

        if (!in_array($d['year_level'], Student::YEAR_LEVELS, true)) {
            return 'Please choose a valid year level.';
        }

        return '';
    }
}