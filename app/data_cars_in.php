<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_cars_in extends Model
{
    //
    protected $table = 'data_cars_ins';
    protected $fillable = ['Date_Car_in','Status_Car_in1','Return_car','Return_new_car','Date_Status_car','Name_Cus_Car','Name_Cus_in', 'Nick_Cus_in', 'Tel_Cus_in', 'Head_Name', 'Sale_Name', 'CarType_in', 'Brand_Car_in', 'Nameid_Car_in', 'id_body_car',  'Miles_Car_in', 'Model_Car_in',  'Gear_Car_in',  'Date_Carry_in', 'Car_Year_in', 'Version_Car_in',  'Size_Car_in','Color_car_in' ,'Cus_Need_price','Detail_Car_in','DateFN','TotalFN','StatusFN_Car_in', 'Other_FN','Datacar_id','created_at','updated_at'];


      public function statusCars()
    {
      return $this->belongsTo(status_cars_in::class);
    }
}
