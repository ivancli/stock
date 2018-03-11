<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricalVolumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::transaction(function () {
            Schema::create('historical_volumes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('company_id')->unsigned();
                $table->bigInteger('amount')->unsigned();
                $table->timestamps();

                $table->index(['company_id']);
                $table->index(['company_id', 'created_at']);
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
            Schema::dropIfExists('historical_volumes');
        });
    }
}
