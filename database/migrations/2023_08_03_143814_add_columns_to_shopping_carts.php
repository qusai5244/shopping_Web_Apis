<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToShoppingCarts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shopping_carts', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('unit_price', 8, 2);
            // Define foreign key constraint
            $table->foreign('product_id')
                ->references('product_id')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shopping_carts', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['product_id']);
            // Remove columns
            $table->dropColumn('product_id');
            $table->dropColumn('quantity');
            $table->dropColumn('unit_price');
        });
    }
}
