<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('password')->nullable();
            $table->string('email')->nullable();
            $table->string('location')->nullable();
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('organization');
            $table->string('organization_unit');
            $table->string('common_name');
            $table->timestamp('expiration');
            $table->longText('csr');
            $table->longText('crt');
            $table->longText('key');
            $table->longText('ca')->nullable();
            $table->longText('cakey')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('certificates');
    }
}
