<?php

namespace App\Models\Repository;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class EnrollmentRepository
{
    public function courseAndStudentRegistered()
    {
        $enrollments = DB::table('enrollments')
        ->leftJoin('students', 'enrollments.student_id', '=', 'students.id')
        ->leftJoin('courses', 'enrollments.course_id', '=', 'courses.id')
        ->select(
            'enrollments.id',
            'students.name as student',
            'courses.name as course',
            'enrollments.active',
            'enrollments.created_at',
        )
        ->get();

    return $enrollments;
    }

    public function checkIsRelationsEmpty()
    {
        $courses = Course::all();
        $students = Student::all();

        if(empty($courses) && empty($students)) {
            return true;
        }

        return false;
    }
}
