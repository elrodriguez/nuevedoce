<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSalNoteTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sal_note_types', function (Blueprint $table) {
            $table->string('id')->index();
            $table->boolean('active');
            $table->string('description');
            $table->boolean('debit')->default(false);
            $table->timestamps();
        });

        DB::table('sal_note_types')->insert([
            ['id' => '01', 'active' => true, 'description' => 'Anulación de la operación','debit' => false],
            ['id' => '02', 'active' => true, 'description' => 'Anulación por error en el RUC','debit' => false],
            ['id' => '03', 'active' => true, 'description' => 'Corrección por error en la descripción','debit' => false],
            ['id' => '04', 'active' => true, 'description' => 'Descuento global','debit' => false],
            ['id' => '05', 'active' => true, 'description' => 'Descuento por ítem','debit' => false],
            ['id' => '06', 'active' => true, 'description' => 'Devolución total','debit' => false],
            ['id' => '07', 'active' => true, 'description' => 'Devolución por ítem','debit' => false],
            ['id' => '08', 'active' => true, 'description' => 'Bonificación','debit' => false],
            ['id' => '09', 'active' => true, 'description' => 'Disminución en el valor','debit' => false],
            ['id' => '10', 'active' => true, 'description' => 'Otros Conceptos','debit' => false],
            ['id' => '11', 'active' => true, 'description' => 'Ajustes de operaciones de exportación','debit' => false],
            ['id' => '12', 'active' => true, 'description' => 'Ajustes afectos al IVAP','debit' => false],
            ['id' => '01', 'active' => true, 'description' => 'Intereses por mora','debit' => true],
            ['id' => '02', 'active' => true, 'description' => 'Aumento en el valor','debit' => true],
            ['id' => '03', 'active' => true, 'description' => 'Penalidades/ otros conceptos','debit' => true],
            ['id' => '10', 'active' => true, 'description' => 'Ajustes de operaciones de exportación','debit'=>true],
            ['id' => '11', 'active' => true, 'description' => 'Ajustes afectos al IVAP','debit' => true],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sal_note_types');
    }
}
