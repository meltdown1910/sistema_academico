<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi información académica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-success mb-4">
        <div class="container">
            <span class="navbar-brand">Sistema académico - Alumno</span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-light btn-sm">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </nav>

    <main class="container">
        <div class="card shadow-sm mx-auto" style="max-width: 650px;">
            <div class="card-body">
                <h2 class="mb-4">Mi información académica</h2>

                <p>
                    <strong>Nombre:</strong>
                    {{ $student->user->name }}
                </p>

                <p>
                    <strong>Correo electrónico:</strong>
                    {{ $student->user->email }}
                </p>

                <hr>

                <h4 class="mb-3">Mis resultados</h4>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card bg-light text-center">
                            <div class="card-body">
                                <h6>Faltas</h6>
                                <h3>{{ $student->absences }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-light text-center">
                            <div class="card-body">
                                <h6>Calificación</h6>
                                <h3>{{ $student->grade }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-light text-center">
                            <div class="card-body">
                                <h6>Equivalencia</h6>
                                <h3>{{ $student->equivalence }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info mt-4 mb-0">
                    En esta sección puedes consultar tu información académica.
                    Si necesitas corregir algún dato, comunícate con tu profesor.
                </div>
            </div>
        </div>
    </main>

</body>
</html>
