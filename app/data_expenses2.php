<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_expenses extends Model
{
    protected $table = 'data_expenses';
    protected $primaryKey = 'id';
    protected $fillable = ['Car_id', 'type_expen', 'text_expen', 'price', 'remark'];

    public function datacar()
    {
        return $this->hasMany(data_car::class);
    }

}
