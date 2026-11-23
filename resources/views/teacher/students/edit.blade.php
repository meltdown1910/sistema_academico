<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <span class="navbar-brand">Sistema académico - Profesor</span>
        </div>
    </nav>

    <main class="container">
        <div class="card shadow-sm mx-auto" style="max-width: 700px;">
            <div class="card-body">
                <h2 class="mb-4">Editar alumno</h2>

                <form action="{{ route('teacher.students.update', $student) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre completo</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $student->user->name) }}" required>

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" name="email" id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $student->user->email) }}" required>

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            Nueva contraseña (opcional)
                        </label>
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror">

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="form-text">
                            Déjala vacía si no deseas cambiar la contraseña.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">
                            Confirmar nueva contraseña
                        </label>
                        <input type="password" name="password_confirmation"
                               id="password_confirmation" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="absences" class="form-label">Número de faltas</label>
                        <input type="number" name="absences" id="absences"
                               class="form-control @error('absences') is-invalid @enderror"
                               value="{{ old('absences', $student->absences) }}"
                               min="0" required>

                        @error('absences')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="grade" class="form-label">Calificación</label>
                        <input type="number" name="grade" id="grade"
                               class="form-control @error('grade') is-invalid @enderror"
                               value="{{ old('grade', $student->grade) }}"
                               min="0" max="100" required>

                        @error('grade')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Guardar cambios
                    </button>

                    <a href="{{ route('teacher.students.index') }}"
                       class="btn btn-secondary">
                        Cancelar
                    </a>
                </form>
            </div>
        </div>
    </main>

</body>
</html>
