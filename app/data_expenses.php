<?php

namespace App;
use App\data_car;
use Illuminate\Database\Eloquent\Model;

class data_expenses extends Model
{
    protected $table = 'data_expenses';
    protected $primaryKey = 'id';
    protected $fillable = ['Car_id','date_bill', 'type_expen', 'text_expen', 'price', 'remark'];

    public function dataExpenToDataCar()
    {
        return $this->belongsTo(data_car::class,'Car_id','id');
    }
}
