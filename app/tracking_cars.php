<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tracking_cars extends Model
{
    protected $table = 'tracking_cars';
    protected $primaryKey = 'id';
    protected $fillable = ['id_cars','status_car','detail_car','track_date','end_date'];

    public function dataCar()
    {
        return $this->belongsTo(dataCustomer::class,'F_DataCus_id');
    }                       
}
