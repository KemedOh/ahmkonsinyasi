<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sellings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->bigInteger('sales_id')->unsigned()->nullable();
            $table->date('date_sell');
            $table->enum('product_status', ['konsinyasi', 'not_konsinyasi'])->default('not_konsinyasi');
            $table->Integer('grand_total');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('sales_id')->references('id')->on('users');

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
