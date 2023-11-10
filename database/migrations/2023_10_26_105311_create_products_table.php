<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('seller_id');
            $table->string('product_name');
            $table->string('product_slug');
            $table->text('product_desc');
            $table->string('product_price');
            $table->integer('nbre_pieces');
            $table->string('product_thumbnail');
            $table->integer('product_status')->default(0);
            $table->integer('special_deal')->nullable();
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
        Schema::dropIfExists('products');
    }
};
