<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Response\HttpResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentCreateRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Resources\StudentResource;

class StudentController extends Controller
{
    public function index()
    {
        $perPage = request('per_page') ?? 3;
        $student = Student::with('department');

        if (request('search')) $student = $student->where('name', 'like', "%" . request('search') . "%");

        $msg = 'list data siswa';
        $student = StudentResource::collection($student->paginate($perPage));
        return HttpResponse::success($msg, $student);
    }

    public function store(StudentCreateRequest $request)
    {
        Log::info("menjalankan fungsi tambah siswa");
        $student = Student::create($request->all());
        Log::info("request");
        Log::debug(request()->all());
        return HttpResponse::success('Data siswa has been created successfully', $student, 201);
    }

    public function show($id)
    {
        $student = Student::select('id', 'nik', 'name', 'gender')->find($id);
        if (!$student) return HttpResponse::error('data siswa not found', 404);
        return HttpResponse::success('data siswa found', $student);
    }

    public function update(StudentUpdateRequest $request, $id)
    {
        $student = Student::find($id);
        if (!$student) return HttpResponse::error('data siswa not found', 404);
        $student->update($request->all());
        return HttpResponse::success('update data siswa successfull', $student);
    }

    public function destroy($id)
    {

        $student = Student::find($id);
        if (!$student) return HttpResponse::error('data siswa not found', 404);
        $student->delete();
        return HttpResponse::success('siswa has been deleted successfully');
    }
}
