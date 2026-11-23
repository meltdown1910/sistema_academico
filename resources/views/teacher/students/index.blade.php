<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de alumnos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <span class="navbar-brand">Sistema académico - Profesor</span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-light btn-sm">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </nav>

    <main class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Lista de alumnos</h2>

            <a href="{{ route('teacher.students.create') }}"
               class="btn btn-success">
                Registrar alumno
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <form action="{{ route('teacher.students.index') }}"
                      method="GET"
                      class="row g-3 align-items-end">

                    <div class="col-md-5">
                        <label for="sort" class="form-label">
                            Ordenar por
                        </label>

                        <select name="sort" id="sort" class="form-select">
                            <option value="name" {{ $sort === 'name' ? 'selected' : '' }}>
                                Nombre
                            </option>

                            <option value="grade" {{ $sort === 'grade' ? 'selected' : '' }}>
                                Calificación
                            </option>

                            <option value="absences" {{ $sort === 'absences' ? 'selected' : '' }}>
                                Faltas
                            </option>
                        </select>
                    </div>

                    <div class="col-md-5">
                        <label for="direction" class="form-label">
                            Dirección
                        </label>

                        <select name="direction" id="direction" class="form-select">
                            <option value="asc" {{ $direction === 'asc' ? 'selected' : '' }}>
                                Ascendente
                            </option>

                            <option value="desc" {{ $direction === 'desc' ? 'selected' : '' }}>
                                Descendente
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            Ordenar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>Nombre</th>
                                <th>Faltas</th>
                                <th>Calificación</th>
                                <th>Equivalencia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($students as $student)
                                <tr>
                                    <td>{{ $student->user->name }}</td>
                                    <td>{{ $student->absences }}</td>
                                    <td>{{ $student->grade }}</td>
                                    <td>{{ $student->equivalence }}</td>
                                    <td>
                                        <a href="{{ route('teacher.students.show', $student) }}"
                                           class="btn btn-info btn-sm">
                                            Ver
                                        </a>

                                        <a href="{{ route('teacher.students.edit', $student) }}"
                                           class="btn btn-warning btn-sm">
                                            Editar
                                        </a>

                                        <form action="{{ route('teacher.students.destroy', $student) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('¿Estás seguro de eliminar este alumno?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        Todavía no hay alumnos registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $students->links() }}
            </div>
        </div>
    </main>

</body>
</html>
