<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilePathToDocumentsTable extends Migration
{
    /**
     * Ejecutar las modificaciones en la migración.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            // Añadir la columna para la ruta del archivo
            $table->string('file_path')->after('name'); // Ruta para guardar los documentos

            // La relación con la tabla projects ya está implementada correctamente
        });
    }

    /**
     * Deshacer las modificaciones en la migración.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            // Eliminar la columna file_path si se deshace la migración
            $table->dropColumn('file_path');
        });
    }
}
