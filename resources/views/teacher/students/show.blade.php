<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Información del alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <span class="navbar-brand">Sistema académico - Profesor</span>
        </div>
    </nav>

    <main class="container">
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <h2 class="mb-4">Información del alumno</h2>

                <p>
                    <strong>Nombre:</strong>
                    {{ $student->user->name }}
                </p>

                <p>
                    <strong>Correo electrónico:</strong>
                    {{ $student->user->email }}
                </p>

                <p>
                    <strong>Número de faltas:</strong>
                    {{ $student->absences }}
                </p>

                <p>
                    <strong>Calificación:</strong>
                    {{ $student->grade }}
                </p>

                <p>
                    <strong>Equivalencia:</strong>
                    {{ $student->equivalence }}
                </p>

                <a href="{{ route('teacher.students.edit', $student) }}"
                   class="btn btn-warning">
                    Editar
                </a>

                <a href="{{ route('teacher.students.index') }}"
                   class="btn btn-secondary">
                    Volver a la lista
                </a>
            </div>
        </div>
    </main>

</body>
</html>
