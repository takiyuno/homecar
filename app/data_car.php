<?php

namespace App;
use App\data_expenses;
use App\TB_PactContracts\Pact_Indentures;

use Illuminate\Database\Eloquent\Model;

class data_car extends Model
{
    // protected $connection = 'sqlsrv2';
    protected $table = 'data_cars';
    protected $fillable = ['F_DataCus_id','Car_type','Type_buy','Date_Auction','create_date','Date_Status','Date_Soldout','Date_Repair','Date_Sale','Date_Color','Date_Wait','Date_Carry',
                          'Brand_Car','Version_Car','Model_Car','Color_Car','Size_Car','Chassis_car','Job_Number','Number_Miles','Gearcar',
                          'Year_Product','Number_Regist','Name_Sale','Net_Price','Repair_Price','com_sale','Comsale_turn','Fisrt_Price','Comsale_turn',
                          'Origin_Car','Color_Price','Return_Price','Add_Price','Insur_Price','Tran_Fee','Cost_Insur','Repair_Remark','Color_Remark','Add_Remark','Intro_Price','Special_Price','Liger_Price','Date_Soldout_plus','Date_Withdraw','Net_Priceplus',
                          'Amount_Price','Name_Saleplus','Type_Sale','Name_Agent','Name_Buyer','Tel_Buyer','Type_Ofsale','Finance_Name','Finance_Amount','Finance_Instal','Price_Thana','Price_NonThana','Price_Tisco','Price_NonTisco','Price_Scb','Price_NonScb','Price_AY','Price_NonAY','Price_Choo','Price_Kiatnakin','Price_KLeasing','comendSale','comendAdmin','Increase','Month_Balance','FirmCase','Date_invoice','SendCar_Date','Po_Date','Contract_Date','Remark_FN','Accounting_Cost','Gift_Set','oil_free','otherGift','Date_Borrowcar','claim_MMTH',
                          'Date_Returncar','Name_Borrow','Note_Borrow','BorrowStatus','Margin_allocation','Vat_car_buy','Vat_car_sale','Balance_Budget',
                          'Down_Price','Transfer_Price','Subdown_Price','Insurance_Price','Topcar_Price',
                          'BookStatus_Car','DateStatus_Car','Expected_Sell','car_link','Expected_Repair','Expected_Color'];
  

    public function datacar()
    {
      return $this->hasMany(checkDocument::class);
    }

    public function dataCus()
    {
      return $this->belongsTo(dataCustomer::class,'F_DataCus_id');
    }
    public function dataCarToExpen()
    {
      return $this->hasMany(data_expenses::class,'Car_id','id');
    }
}
