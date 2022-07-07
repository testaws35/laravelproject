<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('TransactionID');
            $table->integer('Vendor_PaymentID');
			$table->date('TransactionDate');
            $table->string('TransactionTime');
            $table->float('TransactionAmount');
            $table->integer('UserID');
            $table->string('TransactionType');
            $table->string('TransactionStatus');
            $table->string('PaymentMethod');
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
        Schema::dropIfExists('payments');
    }
}

