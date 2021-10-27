<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Repository\EnrollmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $enrollmentRepository = new EnrollmentRepository;
        if ($enrollmentRepository->checkIsRelationsEmpty()){
            return response()->json(['error' => 'Cadastre um alune e um curso para realizar essa função']);
        }

        $enrolment = Enrollment::create($request->all());

        if (!$enrolment) {
            return response()->json(['error' => 'Erro ao cadastrar!'], 400);
        }

        return response()->json(['success' => 'Cadastrado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $enrollments = DB::table('enrollments')
            ->leftJoin('students', 'enrollments.student_id', '=', 'students.id')
            ->leftJoin('courses', 'enrollments.course_id', '=', 'courses.id')
            ->select(
                'enrollments.id',
                'students.name as student',
                'courses.name as course',
                'enrollments.course_id',
                'enrollments.student_id',
                'enrollments.active',
                'enrollments.created_at',
            )->where('enrollments.id', '=', $id)
            ->get();

        return $enrollments;

        if (!$enrollments) {
            return response()->json(['error' => 'Não encontrado'], 400);
        }

        return $enrollments;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $enrollments = DB::table('enrollments')
            ->leftJoin('students', 'enrollments.student_id', '=', 'students.id')
            ->leftJoin('courses', 'enrollments.course_id', '=', 'courses.id')
            ->select(
                'enrollments.id',
                'enrollments.created_at',
                'enrollments.active',
                'courses.name as course',
                'students.name as student'
            )
            ->get();

        if (!$enrollments) {
            return response()->json(['error' => 'Não encontrado'], 400);
        }

        return $enrollments;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $enrolment = Enrollment::findOrFail($id);
        $enrolment->update($request->all());

        return response()->json(['success' => 'Atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enrolment = Enrollment::findOrFail($id);
        $enrolment->delete();

        return response()->json(['success' => 'Deletado com sucesso!']);
    }
}
