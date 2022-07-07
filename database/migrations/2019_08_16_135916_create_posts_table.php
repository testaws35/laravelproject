<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_posts', function (Blueprint $table) {
            $table->increments('FAQ_PostID');
            $table->text('FAQ_Title');
            $table->text('FAQ_Body');
            $table->boolean('FAQ_IsActive');
            $table->integer('FAQ_UserID')->unsigned();
            $table->Date('FAQ_CreatedDate');
          //  $table->timestamps();
        });


    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_posts');
    }
}
