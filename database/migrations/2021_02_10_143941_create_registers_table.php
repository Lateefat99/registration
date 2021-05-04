<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->date('d_o_b');
            $table->text('address');
            $table->string('gender');
            $table->string('teacher');
            $table->string('nationality');
            $table->string('email')->unique()->nullable();
            $table->string('state_of_origin');
            $table->string('health_status');
            $table->string('blood_group')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->string('genotype')->nullable();
            $table->string('allergy')->nullable();
            $table->string('card_number')->unique()->nullable();
            $table->string('filename')->nullable();
            $table->string('reg_number')->unique();
            $table->date('reg_date');
//            $table->string('admitted_class');
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
        Schema::dropIfExists('registers');
    }
}
