<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::transaction(function () {
            Schema::table('companies', function (Blueprint $table) {
                $table->foreign('market_id')->references('id')->on('markets')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('close_historical_quote_id')->references('id')->on('historical_quotes')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('open_historical_quote_id')->references('id')->on('historical_quotes')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('highest_historical_quote_id')->references('id')->on('historical_quotes')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('lowest_historical_quote_id')->references('id')->on('historical_quotes')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('latest_historical_quote_id')->references('id')->on('historical_quotes')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('latest_historical_volume_id')->references('id')->on('historical_volumes')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('latest_historical_market_capital_id')->references('id')->on('historical_market_capitals')
                    ->onUpdate('cascade')->onDelete('cascade');
            });

            Schema::table('historical_quotes', function (Blueprint $table) {
                $table->foreign('company_id')->references('id')->on('companies')
                    ->onUpdate('cascade')->onDelete('cascade');
            });

            Schema::table('historical_volumes', function (Blueprint $table) {
                $table->foreign('company_id')->references('id')->on('companies')
                    ->onUpdate('cascade')->onDelete('cascade');
            });

            Schema::table('historical_market_capitals', function (Blueprint $table) {
                $table->foreign('company_id')->references('id')->on('companies')
                    ->onUpdate('cascade')->onDelete('cascade');
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
            Schema::table('companies', function (Blueprint $table) {
                $table->dropForeign('companies_close_historical_quote_id_foreign');
                $table->dropForeign('companies_highest_historical_quote_id_foreign');
                $table->dropForeign('companies_latest_historical_market_capital_id_foreign');
                $table->dropForeign('companies_latest_historical_quote_id_foreign');
                $table->dropForeign('companies_latest_historical_volume_id_foreign');
                $table->dropForeign('companies_lowest_historical_quote_id_foreign');
                $table->dropForeign('companies_market_id_foreign');
                $table->dropForeign('companies_open_historical_quote_id_foreign');
            });

            Schema::table('historical_quotes', function (Blueprint $table) {
                $table->dropForeign('historical_quotes_company_id_foreign');
            });

            Schema::table('historical_volumes', function (Blueprint $table) {
                $table->dropForeign('historical_volumes_company_id_foreign');
            });

            Schema::table('historical_market_capitals', function (Blueprint $table) {
                $table->dropForeign('historical_market_capitals_company_id_foreign');
            });
        });
    }
}
