<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status_cars_in extends Model
{
    //
    protected $table = 'status_cars_in';
    protected $fillable = ['id_car_in', 'Look_Car_in', 'Price_head', 'Price_Budget', 'Comsale_in', 'Type_Car_in', 'Status_Car_in', 'Status_Detail','Remark','Date_See_Car','date_create', 'date_update'];

     public function dataCarsIn()
    {
      return $this->belongsTo(data_cars_ins::class);
    }
}
