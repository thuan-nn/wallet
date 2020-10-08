<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moneies', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger('category_money_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->float('amount')->default(0);
            $table->timestamps();
            $table->softDeletes();

//            $table->foreign('category_money_id')->references('id')->on('category_money')->onDelete('cascade');
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moneies');
    }
}
