<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->bigIncrements('shipment_id');
            $table->unsignedBigInteger('start_location_id');
            $table->foreign('start_location_id')->references('location_id')->on('locations');
            $table->unsignedBigInteger('end_location_id');
            $table->foreign('end_location_id')->references('location_id')->on('locations');
            $table->string('start_date_expected');
            $table->string('start_date_actual')->nullable();
            $table->string('end_date_expected');
            $table->string('end_date_actual')->nullable();
            $table->text('other_details');
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
        Schema::dropIfExists('shipments');
    }
}
