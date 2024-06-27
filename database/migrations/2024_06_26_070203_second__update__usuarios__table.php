<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SecondUpdateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            if (!Schema::hasColumn('usuarios', 'monto_credito')) {
                $table->decimal('monto_credito', 10, 2)->nullable()->after('password');
            }

            if (!Schema::hasColumn('usuarios', 'motivo_credito')) {
                $table->text('motivo_credito')->nullable()->after('monto_credito');
            }

            if (!Schema::hasColumn('usuarios', 'role')) {
                $table->string('role')->default('user')->after('motivo_credito');
            }
        });
    }

    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            if (Schema::hasColumn('usuarios', 'monto_credito')) {
                $table->dropColumn('monto_credito');
            }

            if (Schema::hasColumn('usuarios', 'motivo_credito')) {
                $table->dropColumn('motivo_credito');
            }

            if (Schema::hasColumn('usuarios', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
}
