<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'owcampos',
            'name' => 'ower armando campos alfonso',
            'email' => 'owerion22@gmail.com',
            'password' => bcrypt('LoreCamiJuli1')
        ])->assignRole('ADMINISTRADOR');

        User::create([
            'username' => 'jvargas',
            'name' => 'javier vargas prieto',
            'email' => 'javapri@outlook.com',
            'password' => bcrypt('javapri')
        ])->assignRole('ADMINISTRADOR');
    }
}
