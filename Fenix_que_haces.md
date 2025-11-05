Modifique patientsController , probablemente les envie el archivo

tambien modifique el Create y el edit del mismo para que tome el tenant de la sesion iniciada tambien pasare los archivos

ahora estoy modificando con un seeder el rol de dentista y paciente

php artisan make:seeder Role_Extra_Seeder


<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class Role_Extra_Seeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(
            ['name' => 'Dentist', 'guard_name' => 'web'],
            ['description' => 'Role for dental professionals']
        );

        Role::firstOrCreate(
            ['name' => 'Patient', 'guard_name' => 'web'],
            ['description' => 'Role for patients in the system']
        );
    }
}





php artisan db:seed --class=Role_Extra_Seeder


MODIFIQUE EL SHOW DE PATIENTS

TAMBIEN EL MODEL Y CONTROLLER DE PATIENTS PARA QUE SE CONECTE CON EL DE HISTORIAL MEDICO, HAY COMENTARIOS

EDIT DE PATIENTS
