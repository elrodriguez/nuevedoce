<?php

use App\Models\Customer;
use App\Models\Person;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->char('country_id',2)->nullable();
            $table->char('department_id',2)->nullable();
            $table->char('province_id',4)->nullable();
            $table->char('district_id',6)->nullable();
            $table->string('identity_document_type_id');
            $table->string('number');
            $table->string('names');
            $table->string('last_name_father')->nullable();
            $table->string('last_name_mother')->nullable();
            $table->string('full_name',500)->nullable();
            $table->string('trade_name',500)->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->char('sex',1)->default('M');
            $table->date('birth_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('identity_document_type_id')->references('id')->on('identity_document_types');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('district_id')->references('id')->on('districts');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id')->nullable();
            $table->foreign('person_id','users_person_id_foreign')->references('id')->on('people');
        });

        DB::table('people')->insert([
            'country_id' => 'PE',
            'department_id' => '02',
            'province_id' => '0218',
            'district_id' => '021801',
            'identity_document_type_id' => '0',
            'number' => '00000000',
            'names' => 'Super',
            'last_name_father' => 'Admin',
            'last_name_mother' => null,
            'full_name' => 'Super Admin',
            'trade_name' => null,
            'address' => 'web',
            'email' => 'admin@gmail.com',
            'telephone' => null,
            'sex' => 'M',
            'birth_date' => '2000-09-30'
        ]);

        DB::table('users')->where('id', 1)->update(['person_id' => 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_person_id_foreign');
            $table->dropColumn('person_id');
        });

        Schema::dropIfExists('people');
    }
}
