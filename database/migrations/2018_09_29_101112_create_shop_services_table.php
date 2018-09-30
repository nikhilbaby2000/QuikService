<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_services', function (Blueprint $table) {
            $table->smallInteger('shop_id');
            $table->smallInteger('service_id');
            $table->decimal('rate', 8, 2);
            $table->unsignedSmallInteger('minutes_required');
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_services');
    }
}
