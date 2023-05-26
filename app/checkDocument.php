<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class checkDocument extends Model
{
    // protected $connection = 'sqlsrv2';
    protected $table = 'check_documents';
    protected $fillable = ['Datacar_id','PDI_220','PDS','Social','Contracts_Car','Manual_Car','Certi_doc','Trans_doc','Id_doc',
    'Regist_car','Regist_house','Act_Car','Insurance_Car','Key_Reserve','Expire_Tax','ChkCondition','ChkTran','Name_CarUser','Doc_file','Doc_file2',
    'Date_NumberUser','Date_Expire','Check_Note'];
  
    public function datacarType()
    {
      return $this->belongsTo(data_car::class,'Datacar_id');
    }
}
