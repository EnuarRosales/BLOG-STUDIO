<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoDescuentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_descuentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',45);
            $table->timestamps();
            $table->softDeletes(); // Agregar esta línea para habilitar eliminación suave
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_descuentos');
    }
}
