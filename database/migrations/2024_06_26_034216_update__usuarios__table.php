<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            // Agregar nuevos campos
            $table->decimal('monto_credito', 10, 2)->nullable()->after('password');
            $table->text('motivo_credito')->nullable()->after('monto_credito');
        });
    }

    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            // Revertir cambios
            $table->dropColumn('monto_credito');
            $table->dropColumn('motivo_credito');
        });
    }
}
