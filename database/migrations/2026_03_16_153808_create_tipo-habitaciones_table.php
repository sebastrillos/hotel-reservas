<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    /**
     * Run the migrations.
     */ 
    public function up() {
    Schema::create('tipo_habitacion', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->text('descripcion')->nullable();
        $table->decimal('precio_base', 8, 2);
    });
    }
    /**
     * Reverse the migrations.
     */

    public function down() {
    Schema::dropIfExists('tipo_habitacion');
    }
};
