<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::transaction(function () {
            Schema::create('companies', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('symbol');
                $table->integer('market_id')->unsigned();
                $table->string('sector')->nullable();
                $table->bigInteger('latest_historical_price_id')->unsigned()->nullable();
                $table->bigInteger('latest_historical_volume_id')->unsigned()->nullable();
                $table->bigInteger('latest_historical_market_capital_id')->unsigned()->nullable();
                $table->timestamps();

                $table->index(['symbol']);
                $table->index(['symbol', 'market_id']);
                $table->unique(['symbol', 'market_id']);
                $table->index(['sector']);
                $table->index(['market_id', 'sector']);
                $table->index(['symbol', 'market_id', 'sector']);
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
            Schema::dropIfExists('companies');
        });
    }
}
