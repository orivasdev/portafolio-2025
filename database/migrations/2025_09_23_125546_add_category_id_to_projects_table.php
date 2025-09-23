<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Agregar la columna category_id
            $table->unsignedBigInteger('category_id')->nullable()->after('id');
            
            // Agregar la clave foránea
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            
            // Agregar índice para mejor rendimiento
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Eliminar la clave foránea
            $table->dropForeign(['category_id']);
            
            // Eliminar el índice
            $table->dropIndex(['category_id']);
            
            // Eliminar la columna
            $table->dropColumn('category_id');
        });
    }
};
