<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailSentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_sents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('website_id');
            $table->unsignedBigInteger('for_post');
            $table->string('status')->default('not_sent');
            $table->timestamps();

            $table->foreign('website_id')->on('websites')->references('id');
            $table->foreign('for_post')->on('posts')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_sents');
    }
}
