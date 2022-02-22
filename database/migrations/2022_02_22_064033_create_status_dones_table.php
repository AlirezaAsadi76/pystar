<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusDonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_dones', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->text('description');
            $table->string('destinationFirstname');
            $table->string('destinationLastname');
            $table->string('destinationNumber');
            $table->string('inquiryDate');
            $table->integer('inquirySequence');
            $table->string('inquiryTime');
            $table->text('message')->default(' ');
            $table->string('paymentNumber')->unique();
            $table->string('refCode')->unique();


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
        Schema::dropIfExists('status_dones');
    }
}
