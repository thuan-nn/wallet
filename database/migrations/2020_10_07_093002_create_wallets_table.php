<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->integer( 'user_id')->unsigned();
            $table->integer('category_wallet_id')->unsigned();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('category_wallet_id')->references('id')->on('category_wallet')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('wallets');
    }
}
