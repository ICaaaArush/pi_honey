<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorBrandSizeQualityColumnsToMainProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('main_products', function (Blueprint $table) {
            $table->foreignId('brand_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->nullable()->default(null);
            $table->foreignId('quality_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->nullable()->default(null);
            $table->foreignId('size_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->nullable()->default(null);
            $table->foreignId('color_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('main_products', function (Blueprint $table) {
            //
        });
    }
}
