<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTable extends Migration
{
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('round_id');
            $table->unsignedInteger('card_id');
            $table->string('location');
            $table->unsignedBigInteger('model_id')->nullable();
            $table->string('model_type')->nullable();
            $table->timestamps();

            $table->foreign('round_id')->references('id')->on('rounds')->onDelete('cascade');
        });
    }
}
