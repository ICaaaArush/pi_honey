<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotaSortedInMainProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('main_products', function (Blueprint $table) {
            $table->string('total_sorted')->default(0)->nullable();
            $table->foreignId('season_id')->constrained()->onUpdate('cascade')->onDelete('cascade')->nullable()->default(null);

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
