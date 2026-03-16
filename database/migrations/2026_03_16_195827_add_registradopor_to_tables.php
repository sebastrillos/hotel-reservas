<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = ['cancelaciones', 'pagos', 'tipo_habitacion'];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->string('registradopor')->nullable();
            });
        }
    }

    public function down(): void
    {
        $tables = [ 'cancelaciones', 'pagos', 'tipo_habitacion'];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('registradopor');
            });
        }
    }
};