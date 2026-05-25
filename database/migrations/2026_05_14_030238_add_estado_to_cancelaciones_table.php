<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cancelaciones', function (Blueprint $table)
        {
            $table->boolean('estado')
                ->default(1)
                ->after('fecha_cancelacion');
        });
    }

    public function down(): void
    {
        Schema::table('cancelaciones', function (Blueprint $table)
        {
            $table->dropColumn('estado');
        });
    }
};
