<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSurplusTempWalletTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('wallets', function (Blueprint $table) {
            $table->decimal('surplus_amount', 15, 2)->change();
            $table->decimal('surplus_amount_temp', 15, 2)->after('surplus_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }
}
