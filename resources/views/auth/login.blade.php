<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión - Sistema académico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <main class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-sm w-100" style="max-width: 420px;">
            <div class="card-body p-4">
                <h2 class="text-center mb-2">Sistema académico</h2>
                <p class="text-center text-muted mb-4">
                    Inicia sesión para continuar
                </p>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Correo electrónico
                        </label>

                        <input type="email" name="email" id="email"
                               class="form-control"
                               value="{{ old('email') }}"
                               required autofocus>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">
                            Contraseña
                        </label>

                        <input type="password" name="password" id="password"
                               class="form-control"
                               required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Iniciar sesión
                    </button>
                </form>
            </div>
        </div>
    </main>

</body>
</html>
