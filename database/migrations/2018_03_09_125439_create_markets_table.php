<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::transaction(function () {
            Schema::create('markets', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('symbol');
                $table->string('resource_url', 2083);
                $table->string('type')->default('csv');
                $table->boolean('active')->default(1);
                $table->timestamps();

                $table->index(['name']);
                $table->index(['symbol']);
                $table->index(['active']);
                $table->index(['name', 'symbol']);
                $table->index(['name', 'active']);
                $table->index(['symbol', 'active']);
                $table->index(['name', 'symbol', 'active']);
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::transaction(function () {
            Schema::dropIfExists('markets');
        });
    }
}
