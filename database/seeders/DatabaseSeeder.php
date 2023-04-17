<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curso;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Curso::factory(50)->create();
        User::factory(50)->create();


        // \App\Models\

        /*
        //SEEDERS NOS PERMITEN LLENAR UNA BASE DE DATOS DE MANERA DETALLADA
        $curso = new Curso();

        $curso->name = "linux";
        $curso->descripcion= "hacker etico";     
        $curso->save();

        $curso2 = new Curso();

        $curso2->name = "javascript";
        $curso2->descripcion= "bueno";     
        $curso2->save();*/

    }


    
}
 