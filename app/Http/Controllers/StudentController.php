<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    // Mostrar todos los alumnos y permitir ordenarlos.
    public function index(Request $request)
    {
        $datos = $request->validate([
            'sort' => ['nullable', 'in:name,grade,absences'],
            'direction' => ['nullable', 'in:asc,desc'],
        ]);

        $sort = $datos['sort'] ?? 'name';
        $direction = $datos['direction'] ?? 'asc';

        $students = Student::with('user')
            ->when($sort === 'name', function ($query) use ($direction) {
                $query->orderBy(
                    User::select('name')
                        ->whereColumn('users.id', 'students.user_id'),
                    $direction
                );
            })
            ->when($sort === 'grade', function ($query) use ($direction) {
                $query->orderBy('grade', $direction);
            })
            ->when($sort === 'absences', function ($query) use ($direction) {
                $query->orderBy('absences', $direction);
            })
            ->paginate(10)
            ->withQueryString();

        return view('teacher.students.index', compact(
            'students',
            'sort',
            'direction'
        ));
    }

    // Mostrar formulario para registrar un alumno.
    public function create()
    {
        return view('teacher.students.create');
    }

    // Registrar un alumno y su cuenta de acceso.
    public function store(Request $request)
    {
        $datos = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'absences' => ['required', 'integer', 'min:0'],
            'grade' => ['required', 'integer', 'between:0,100'],
        ]);

        DB::transaction(function () use ($datos) {
            $user = User::create([
                'name' => $datos['name'],
                'email' => $datos['email'],
                'password' => $datos['password'],
                'role' => 'student',
            ]);

            Student::create([
                'user_id' => $user->id,
                'absences' => $datos['absences'],
                'grade' => $datos['grade'],
            ]);
        });

        return redirect()->route('teacher.students.index')
            ->with('success', 'Alumno registrado correctamente.');
    }

    // Mostrar información de un alumno.
    public function show(Student $student)
    {
        $student->load('user');

        return view('teacher.students.show', compact('student'));
    }

    // Mostrar formulario para editar un alumno.
    public function edit(Student $student)
    {
        $student->load('user');

        return view('teacher.students.edit', compact('student'));
    }

    // Actualizar los datos del alumno.
    public function update(Request $request, Student $student)
    {
        $datos = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $student->user_id,
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'absences' => ['required', 'integer', 'min:0'],
            'grade' => ['required', 'integer', 'between:0,100'],
        ]);

        DB::transaction(function () use ($datos, $student) {
            $student->user->update([
                'name' => $datos['name'],
                'email' => $datos['email'],
            ]);

            if (!empty($datos['password'])) {
                $student->user->update([
                    'password' => $datos['password'],
                ]);
            }

            $student->update([
                'absences' => $datos['absences'],
                'grade' => $datos['grade'],
            ]);
        });

        return redirect()->route('teacher.students.index')
            ->with('success', 'Información del alumno actualizada correctamente.');
    }

    // Eliminar un alumno y su cuenta de acceso.
    public function destroy(Student $student)
    {
        $student->user()->delete();

        return redirect()->route('teacher.students.index')
            ->with('success', 'Alumno eliminado correctamente.');
    }
}
