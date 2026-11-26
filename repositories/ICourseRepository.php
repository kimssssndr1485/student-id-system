<?php
interface ICourseRepository
{
    public static function getCourses(): array;
    public static function countByCourse(): array;
}