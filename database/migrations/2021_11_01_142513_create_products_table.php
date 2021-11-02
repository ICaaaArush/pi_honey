<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('name')->nullable();
            $table->integer('quantity')->nullable();
            $table->float('costing')->nullable();
            $table->float('price')->nullable();
            $table->float('profit')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();;
            $table->foreign('category_id')->references('id')->on('categories')->nullable();
            $table->unsignedBigInteger('sub_category_id')->nullable();;
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->nullable();
            $table->string('bar_code_sh')->nullable(); // SH = SUPPLYHANDLER
            $table->string('bar_code_deh')->nullable(); // DEH = DATAENTRYHANDLER
            $table->string('bar_code_ma')->nullable(); // MA = MANAGER
            $table->boolean('status')->default(0);
            $table->string('delivery_method')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();;
            $table->foreign('supplier_id')->references('id')->on('supplier_details');
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
}
