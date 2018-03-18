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
                $table->integer('market_id')->unsigned()->nullable();
                $table->string('sector')->nullable();
                $table->string('industry')->nullable();
                $table->bigInteger('close_historical_quote_id')->unsigned()->nullable();
                $table->bigInteger('open_historical_quote_id')->unsigned()->nullable();
                $table->bigInteger('highest_historical_quote_id')->unsigned()->nullable();
                $table->bigInteger('lowest_historical_quote_id')->unsigned()->nullable();
                $table->bigInteger('latest_historical_quote_id')->unsigned()->nullable();
                $table->bigInteger('latest_historical_volume_id')->unsigned()->nullable();
                $table->bigInteger('latest_historical_market_capital_id')->unsigned()->nullable();
                $table->timestamps();

                $table->index(['market_id']);
                $table->index(['symbol']);
                $table->index(['sector']);
                $table->index(['industry']);
                $table->index(['market_id', 'symbol']);
                $table->unique(['market_id', 'symbol']);
                $table->index(['market_id', 'sector']);
                $table->index(['market_id', 'industry']);
                $table->index(['market_id', 'symbol', 'sector']);
                $table->index(['market_id', 'symbol', 'industry']);
                $table->index(['market_id', 'sector', 'industry']);
                $table->index(['market_id', 'symbol', 'sector', 'industry']);
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
