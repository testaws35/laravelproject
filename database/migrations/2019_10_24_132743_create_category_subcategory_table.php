<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorySubcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demo_category', function (Blueprint $table) {

            $table->increments('CategoryID');


            $table->string('CategoryName');

            $table->boolean('Status');

            $table->timestamps();

        });


        Schema::create('demo_subcategory', function (Blueprint $table) {

            $table->increments('SubCategoryID');

            $table->integer('CategoryID');

            $table->string('SubCategoryName');

            $table->string('Status');

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
    Schema::drop('demo_category');
    Schema::drop('demo_subcategory');
    }

    
}
