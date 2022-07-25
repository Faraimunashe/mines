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
        Schema::create('mineral_sales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('buyer_id');
            $table->bigInteger('mineral_id');
            $table->decimal('selling_amount');
            $table->decimal('mine_amount');
            $table->decimal('system_amount');
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
        Schema::dropIfExists('mineral_sales');
    }
};
