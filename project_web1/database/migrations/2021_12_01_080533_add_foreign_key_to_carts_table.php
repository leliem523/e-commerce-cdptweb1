<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user')->change();
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_product')->change();
            $table->foreign('id_product')->references('id')->on('products');
            $table->unsignedInteger('quantity')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropForeign(['id_product']);
            // $table->integer('id_user')->change();
            // $table->integer('id_product')->change();
            // $table->integer('quantity')->change();
        });
    }
}
