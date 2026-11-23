<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'profesor@academico.com'],
            [
                'name' => 'Profesor Administrador',
                'password' => 'Profesor123',
                'role' => 'teacher',
            ]
        );
    }
}
