<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('introduction');
            $table->text('about')->nullable();
            $table->longText('description');
            $table->integer('calification')->nullable();
            $table->boolean('featured')->default(false);
            $table->String('slug')->unique();
            $table->softDeletes();

            //FK
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            //FK
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');

            //FK
            $table->unsignedBigInteger('clasification_id')->nullable();
            $table->foreign('clasification_id')->references('id')->on('clasifications');
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
        Schema::dropIfExists('news');
    }
}
