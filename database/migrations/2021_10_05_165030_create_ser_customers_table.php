<?php

use App\Models\Customer;
use App\Models\Person;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('person_id')->nullable(); //Persona
            $table->boolean('direct')->default(false);
            $table->string('photo')->default(''); //Foto Cliente
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->boolean('state')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('person_id')->references('id')->on('people');
        });

        $person = Person::create([
            'country_id' => 'PE',
            'department_id' => '02',
            'province_id' => '0218',
            'district_id' => '021801',
            'identity_document_type_id' => '0',
            'number' => '99999999',
            'names' => 'Clientes',
            'last_name_father' => 'Varios',
            'last_name_mother' => null,
            'full_name' => 'Clientes Varios',
            'trade_name' => 'Clientes Varios',
            'address' => 'web',
            'email' => 'clientesvarios@gmail.com',
            'telephone' => null,
            'sex' => 'M',
            'birth_date' => '2000-09-30'
        ]);

        Customer::create([
            'person_id' => $person->id,
            'direct'    => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
