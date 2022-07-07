<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('ProductID');
            $table->integer('SellerID');
            $table->integer('SubCategoryID');
            $table->string('ProductName,200');
            $table->string('Description');
            $table->binary('Photo');
            $table->float('Weight');
          
            $table->integer('Createdby');
            $table->datetime('CreatedOn');
            $table->boolean('Status');
            $table->integer('Modifiedby');
            $table->datetime('ModifiedOn');
            //$table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
