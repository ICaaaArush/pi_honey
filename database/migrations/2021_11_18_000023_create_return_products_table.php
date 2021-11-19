<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('main_product_barcode')->constrained()->onUpdate('cascade')->onDelete('cascade')->nullable()->default(null);
            $table->foreignId('order_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->nullable()->default(null);
            $table->foreignId('user_phone')->constrained()->onUpdate('cascade')->onDelete('cascade')->nullable()->default(null);
            $table->string('note')->nullable();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('return_products');
    }
}
