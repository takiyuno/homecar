<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataCarsInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_cars_ins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Date_Car_in')->nullable();
            $table->string('Name_Cus_Car')->nullable();
            $table->string('Name_Cus_in')->nullable();
            $table->string('Nick_Cus_in')->nullable();
            $table->string('Tel_Cus_in')->nullable();
            $table->string('Head_Name')->nullable();
            $table->string('Sale_Name')->nullable();
            $table->string('CarType_in')->nullable();
            $table->string('Brand_Car_in')->nullable();
            $table->string('Nameid_Car_in')->nullable();
            $table->string('Model_Car_in')->nullable();
            $table->string('Gear_Car_in')->nullable();
            $table->string('Date_Carry')->nullable();
            $table->string('Car_Year_in')->nullable();
            $table->string('Version_Car_in')->nullable();
            $table->string('Size_Car_in')->nullable();
            $table->string('Detail_Car_in')->nullable();
            $table->string('StatusFN_Car_in')->nullable();
          
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
        Schema::dropIfExists('data_cars_ins');
    }
}
