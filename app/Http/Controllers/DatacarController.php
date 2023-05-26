<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use PDF;
use Storage;
use File;

use App\data_car;
use App\Holdcar;
use App\dataCustomer;
use App\checkDocument;
use App\UploadfileImage;
use App\repair_part;
use App\tracking_cars;
use App\data_expenses;
use Intervention\Image\ImageManagerStatic as Image;

class DatacarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $fdate = '';
      $tdate = '';
      $carType = '';

      if ($request->has('Fromdate')) {
        $fdate = $request->get('Fromdate');
      }
      if ($request->has('Todate')) {
        $tdate = $request->get('Todate');
      }
      if ($request->has('carType')) {
        $carType = $request->get('carType');
      }

        if ($request->type == 1) {              //หน้าแรก
          if ($request->get('Fromdate') or $request->get('Todate') != NULL){
            $fdate = \Carbon\Carbon::parse($fdate)->format('Y')."-". \Carbon\Carbon::parse($fdate)->format('m')."-". \Carbon\Carbon::parse($fdate)->format('d');
            $tdate = \Carbon\Carbon::parse($tdate)->format('Y')."-". \Carbon\Carbon::parse($tdate)->format('m')."-". \Carbon\Carbon::parse($tdate)->format('d');
          }

          if ($request->has('carType') != Null) {
            $data = DB::table('data_cars')
            ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                //->leftjoin('uploadfile_images','data_cars.id','=','uploadfile_images.Datacarfileimage_id')
            ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
              return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
            })
            ->when(!empty($carType), function($q) use($carType){
              return $q->where('data_cars.Car_type',$carType);
            })
            ->orderBy('data_cars.Brand_Car', 'ASC')
            ->get();

          }else {
            $data = DB::table('data_cars')
            ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                //->leftjoin('uploadfile_images','data_cars.id','=','uploadfile_images.Datacarfileimage_id')
            ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
              return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
            })
            ->where('data_cars.Car_type','<>',6)
            ->orderBy('data_cars.Brand_Car', 'ASC')
            ->get();
          }
          
          $fdate = $request->get('Fromdate');
          $tdate = $request->get('Todate');
          $title = 'รถยนต์ทั้งหมด';
        }
        elseif ($request->type == 2) {          //รถยนต์ระหว่างทำสี
          $data = DB::table('data_cars')
          ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                      //->leftjoin('uploadfile_images','data_cars.id','=','uploadfile_images.Datacarfileimage_id')
          ->where('data_cars.Car_type','=',2)
          ->orderBy('data_cars.Brand_Car', 'ASC')
          ->get();
          $title = 'รถยนต์ระหว่างทำสี';
        }
        elseif ($request->type == 3) {          //รถยนต์รอซ่อม
          $data = DB::table('data_cars')
          ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                      //->leftjoin('uploadfile_images','data_cars.id','=','uploadfile_images.Datacarfileimage_id')
          ->where('data_cars.Car_type','=',3)
          ->orderBy('data_cars.Brand_Car', 'ASC')
          ->get();
          $title = 'รถยนต์รอซ่อม';
        }
        elseif ($request->type == 4) {       //รถยนต์ระหว่างซ่อม
          $data = DB::table('data_cars')
          ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                     // ->leftjoin('uploadfile_images','data_cars.id','=','uploadfile_images.Datacarfileimage_id')
          ->where('data_cars.Car_type','=',4)
          ->orderBy('data_cars.Brand_Car', 'ASC')
          ->get();
          $title = 'รถยนต์ระหว่างซ่อม';
        }
        elseif ($request->type == 5) {          //รถยนต์ที่พร้อมขาย
          $data = DB::table('data_cars')
          ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                      //->leftjoin('uploadfile_images','data_cars.id','=','uploadfile_images.Datacarfileimage_id')
          ->where('data_cars.Car_type','=',5)
          ->orderBy('data_cars.BookStatus_Car', 'DESC')
          ->orderBy('data_cars.create_date', 'DESC')
          ->get();
          $title = 'รถยนต์ที่พร้อมขาย';
        }
        elseif ($request->type == 6) {          //รถยนต์ที่ขายแล้ว
          if ($request->get('Fromdate') or $request->get('Todate') != NULL){
            $fdate = \Carbon\Carbon::parse($fdate)->format('Y')."-". \Carbon\Carbon::parse($fdate)->format('m')."-". \Carbon\Carbon::parse($fdate)->format('d');
            $tdate = \Carbon\Carbon::parse($tdate)->format('Y')."-". \Carbon\Carbon::parse($tdate)->format('m')."-". \Carbon\Carbon::parse($tdate)->format('d');
          }
          
          $data = DB::table('data_cars')
          ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
              //->leftjoin('uploadfile_images','data_cars.id','=','uploadfile_images.Datacarfileimage_id')
          ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
            return $q->whereBetween('data_cars.Date_Soldout_plus',[$fdate,$tdate]);
          })
          ->where('data_cars.Car_type','=',6)
          ->orderBy('data_cars.Date_Soldout_plus', 'DESC')
          ->get();

          $fdate = $request->get('Fromdate');
          $tdate = $request->get('Todate');
          $title = 'รถยนต์ที่ขายแล้ว';
        }
        elseif ($request->type == 7) {          //รถยนต์นำเข้าใหม่
          $data = DB::table('data_cars')
          ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                        //->leftjoin('uploadfile_images','data_cars.id','=','uploadfile_images.Datacarfileimage_id')
          ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
           return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
         })
          ->where('data_cars.Car_type','=',1)
          ->orderBy('data_cars.create_date', 'DESC')
          ->get();
          $title = 'รถยนต์นำเข้าใหม่';
        }
        elseif ($request->type == 8) {          //รถยืมใช้
          $data = DB::table('data_cars')
          ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                        //->leftjoin('uploadfile_images','data_cars.id','=','uploadfile_images.Datacarfileimage_id')
          ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
           return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
         })
          ->where('data_cars.BorrowStatus','=','1')
          ->orderBy('data_cars.create_date', 'DESC')
          ->get();
          $title = 'รถยืมใช้';
        }
        elseif($request->type == 9) {
          $data = DB::table('data_cars')
          ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                //->leftjoin('uploadfile_images','data_cars.id','=','uploadfile_images.Datacarfileimage_id')
            // ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
            //   return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
            // })
          ->where('data_cars.Car_type','<>',6)
          ->orderBy('data_cars.BookStatus_Car', 'DESC')
          ->get(); 

          $fdate = $request->get('Fromdate');
          $tdate = $request->get('Todate');
          $title = 'รายงานเอกสาร';
        }

        elseif ($request->type == 11){         //หน้าข้อมูลยอด
          $data1 = data_car::count(); //รถในสต็อกทั้งหมด
          $data2 = data_car::where('Car_type', '=', 2 )->count(); //ระหว่างทำสี
          $data3 = data_car::where('Car_type', '=', 3 )->count(); //รอซ่อม
          $data4 = data_car::where('Car_type', '=', 4 )->count(); //ระหว่างซ่อม
          $data5 = data_car::where('Car_type', '=', 5 )->count(); //พร้อมขาย
          $data6 = data_car::where('Car_type', '=', 6 )->count(); //ขายแล้ว
          $data0 = data_car::where('Car_type', '=', 1 )->count(); //นำเข้าใหม่


          $type = $request->type;
          return view('homecar.home', compact('data1', 'data2', 'data3', 'data4', 'data5', 'data6','type', 'data0'));

        }
        elseif ($request->type == 12){          //สต๊อกรถเร่งรัด
          $data = DB::connection('sqlsrv2')->table('holdcars')
          ->where('holdcars.Statuscar', '=', 5)
                // ->where('holdcars.StatSold_Homecar', '=', NULL)
          ->orderBy('holdcars.Date_hold', 'ASC')
          ->get();

          // dd($data);
          $dataDB = DB::table('data_cars')
          ->get();

          $title = 'รถยึดจากเร่งรัด';
          $type = $request->type;
          return view('homecar.view', compact('data','dataDB','title','type'));
        }
        elseif ($request->type == 13) {
          $data = DB::table('data_cars')
          ->select('data_cars.Brand_Car')
          ->where('data_cars.Car_type','=',6)
          ->groupBy('data_cars.Brand_Car')
          ->get();

          // dd($data);
          $type = $request->type;
          return view('homecar.viewDetail',compact('type','data'));
        }
        elseif ($request->type == 14) {         //รถยนต์ส่งประมูล

          if ($request->get('Fromdate') or $request->get('Todate') != NULL){
            $fdate = \Carbon\Carbon::parse($fdate)->format('Y')."-". \Carbon\Carbon::parse($fdate)->format('m')."-". \Carbon\Carbon::parse($fdate)->format('d');
            $tdate = \Carbon\Carbon::parse($tdate)->format('Y')."-". \Carbon\Carbon::parse($tdate)->format('m')."-". \Carbon\Carbon::parse($tdate)->format('d');
          }

          $data = DB::table('data_cars')
          ->leftjoin('check_documents','data_cars.id','=','check_documents.Datacar_id')
          ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
            return $q->whereBetween('data_cars.Date_Status',[$fdate,$tdate]);
          })
          ->where('data_cars.Car_type','=','7')
          ->orderBy('data_cars.Date_Status', 'DESC')
          ->get();

          $SumAmount = 0;
          $Sum = 0;
          $SumAuction = 0;
          if ($data != NULL) {
            foreach ($data as $key => $value) {
              $Sum += $value->Fisrt_Price+$value->Repair_Price+$value->Offer_Price+$value->Color_Price+$value->Add_Price;
              $SumAuction += $value->Close_auction;
            }
            $SumAmount = $SumAuction - $Sum;
          }

          $fdate = $request->get('Fromdate');
          $tdate = $request->get('Todate');
          $title = 'รถยนต์ส่งประมูล';
          $type = $request->type;

          return view('homecar.view',compact('title','type','data','fdate','tdate','SumAmount'));
        }
        elseif ($request->type == 99) {
          $type = $request->type;
          return view('homecar.chart',compact('type'));
        }
        elseif ($request->type == 100) {
          if ($request->get('Fromdate') or $request->get('Todate') != NULL){
            $fdate = \Carbon\Carbon::parse($fdate)->format('Y')."-". \Carbon\Carbon::parse($fdate)->format('m')."-". \Carbon\Carbon::parse($fdate)->format('d');
            $tdate = \Carbon\Carbon::parse($tdate)->format('Y')."-". \Carbon\Carbon::parse($tdate)->format('m')."-". \Carbon\Carbon::parse($tdate)->format('d');
          }
          $data = DB::table('data_cars')
          ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                  // ->leftjoin('uploadfile_images','data_cars.id','=','uploadfile_images.Datacarfileimage_id')
          ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
            return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
          })
                  // ->where('data_cars.Car_type','<>',6)
          ->when(!empty($carType), function($q) use($carType){
            return $q->where('data_cars.Car_type',$carType);
          })
          ->orderBy('data_cars.created_at', 'DESC')
          ->get();

          $title = 'รายการรถยนต์';
          $type = $request->type;
          $fdate = $request->get('Fromdate');
          $tdate = $request->get('Todate');

          return view('mechanic.view', compact('data','title','type','fdate','tdate','carType'));
        }

        $type = $request->type;
        return view('homecar.view', compact('data','title','type','fdate','tdate','carType'));
      }

      public function SearchData(Request $request, $type)
      {
        if ($type == 1) {
          $NameBrandcar = $request->get('select');
          
          $data = DB::table('data_cars')
          ->select('data_cars.Version_Car')
          ->where('data_cars.Car_type','=',6)
          ->where('data_cars.Brand_Car','=', $NameBrandcar)
          ->groupBy('data_cars.Version_Car')
          ->get();
          
          $output = '<option value="">เลือกรุ่นรถ</option>';
          foreach($data as $row){
            $output.='<option value="'.$row->Version_Car.'">'.$row->Version_Car.'</option>';
          }
          
          echo $output;
        }
        elseif ($type == 2) {
          $NameVersionCar = $request->get('select1');
          
          $data = DB::table('data_cars')
          ->select('data_cars.Year_Product')
          ->where('data_cars.Car_type','=',6)
          ->where('data_cars.Version_Car','=', $NameVersionCar)
          ->groupBy('data_cars.Year_Product')
          ->get();

          $output = '<option value="">เลือกปีรถ</option>';
          foreach($data as $row){
            $output.='<option value="'.$row->Year_Product.'">'.$row->Year_Product.'</option>';
          }
          
          echo $output;
        }
        elseif ($type == 3) {
          $GetVersion = $request->get('select1');
          $YearCar = $request->get('select2');

          $data = DB::table('data_cars')
          ->select('data_cars.*')
          ->where('data_cars.Car_type','=',6)
          ->where('data_cars.Version_Car','=', $GetVersion)
          ->where('data_cars.Year_Product','=', $YearCar)
          ->orderBy('data_cars.create_date', 'DESC')
          ->get();

          $SumPrice = 0;
          $output='<table class="table table-striped table-valign-middle">
          <thead class="thead-dark">
          <tr>
          <th class="text-center">ลำดับ</th>
          <th class="text-center">วันที่ซื้อ</th>
          <th class="text-center">ราคาซื้อ</th>
          <th class="text-center">ราคาต้นทุน</th>
          <th class="text-center">วันที่ขาย</th>
          <th class="text-center">ราคาขาย</th>
          <th class="text-center">ที่มา</th>
          </tr>
          </thead>';
          foreach($data as $key => $row){
            $SetKey = $key + 1;
            $create_date = date_create($row->create_date);
            $create_Soldout = date_create($row->Date_Soldout_plus);
            $SumPrice = $row->Fisrt_Price + $row->Repair_Price + $row->Offer_Price + $row->Color_Price + $row->Add_Price;

            if ($row->Origin_Car == 1) {
              $Type = 'CKL';
            }elseif ($row->Origin_Car == 2) {
              $Type = 'รถประมูล';
            }
            elseif ($row->Origin_Car == 3) {
              $Type = 'รถยึด';
            }
            elseif ($row->Origin_Car == 4) {
              $Type = 'ฝากขาย';
            }
            elseif ($row->Origin_Car == 5) {
              $Type = 'เทิร์นรถใหม่';
            }
            elseif ($row->Origin_Car == 6) {
              $Type = 'เทิร์นรถมือสอง';
            }
            elseif ($row->Origin_Car == 7) {
              $Type = 'ซื้อหน้าเต็นท์';
            }
            elseif ($row->Origin_Car == 8) {
              $Type = 'นายหน้า';
            }
             elseif ($row->Origin_Car == 9) {
              $Type = 'เทิร์นรถ GWM';
            }

            $output.='<tr>
            <td class="text-center">'.$SetKey.'</td>
            <td class="text-center">'.date_format($create_date, 'd-m-Y').'</td>
            <td class="text-center">'.number_format($row->Fisrt_Price, 2).'</td>
            <td class="text-center">'.number_format($SumPrice, 2).'</td>
            <td class="text-center">'.date_format($create_Soldout, 'd-m-Y').'</td>
            <td class="text-center">'.number_format($row->Net_Priceplus, 2).'</td>
            <td class="text-center">'.$Type.'</td>
            </tr>';
          }
          $output.='</table>';
          
          echo $output;
        }
        elseif($type == 4){
          $NameBrandcar = $request->get('select');
          $data = DB::table('data_cars')
          ->select('data_cars.*')
          ->where('data_cars.Car_type','=',6)
          ->where('data_cars.Brand_Car','=', $NameBrandcar)
          ->orderBy('data_cars.create_date', 'DESC')
          ->get();

          $SumPrice = 0;
          $output='<table class="table table-striped table-valign-middle">
          <thead class="thead-dark">
          <tr>
          <th class="text-center">ลำดับ</th>
          <th class="text-center">วันที่ซื้อ</th>
          <th class="text-center">ราคาซื้อ</th>
          <th class="text-center">ราคาต้นทุน</th>
          <th class="text-center">วันที่ขาย</th>
          <th class="text-center">ราคาขาย</th>
          <th class="text-center">ที่มา</th>
          </tr>
          </thead>';
          foreach($data as $key => $row){
            $SetKey = $key + 1;
            $create_date = date_create($row->create_date);
            $create_Soldout = date_create($row->Date_Soldout_plus);
            $SumPrice = $row->Fisrt_Price + $row->Repair_Price + $row->Offer_Price + $row->Color_Price + $row->Add_Price;

            if ($row->Origin_Car == 1) {
              $Type = 'CKL';
            }elseif ($row->Origin_Car == 2) {
              $Type = 'รถประมูล';
            }
            elseif ($row->Origin_Car == 3) {
              $Type = 'รถยึด';
            }
            elseif ($row->Origin_Car == 4) {
              $Type = 'ฝากขาย';
            }
            elseif ($row->Origin_Car == 5) {
              $Type = 'เทิร์นรถใหม่';
            }
            elseif ($row->Origin_Car == 6) {
              $Type = 'เทิร์นรถมือสอง';
            }
            elseif ($row->Origin_Car == 7) {
              $Type = 'ซื้อหน้าเต็นท์';
            }elseif ($row->Origin_Car == 8) {
              $Type = 'นายหน้า';
            }elseif ($row->Origin_Car == 9) {
              $Type = 'เทิร์นรถ GWM';
            }


            $output.='<tr>
            <td class="text-center">'.$SetKey.'</td>
            <td class="text-center">'.date_format($create_date, 'd-m-Y').'</td>
            <td class="text-center">'.number_format($row->Fisrt_Price, 2).'</td>
            <td class="text-center">'.number_format($SumPrice, 2).'</td>
            <td class="text-center">'.date_format($create_Soldout, 'd-m-Y').'</td>
            <td class="text-center">'.number_format($row->Net_Priceplus, 2).'</td>
            <td class="text-center">'.$Type.'</td>
            </tr>';
          }
          $output.='</table>';
          echo $output;
        }
        elseif($type == 5){
          $NameBrandcar = $request->get('brand');
          $NameVersionCar = $request->get('version');

          $data = DB::table('data_cars')
          ->select('data_cars.*')
          ->where('data_cars.Car_type','=',6)
          ->where('data_cars.Brand_Car','=', $NameBrandcar)
          ->where('data_cars.Version_Car','=', $NameVersionCar)
          ->orderBy('data_cars.create_date', 'DESC')
          ->get();

          $SumPrice = 0;
          $output='<table class="table table-striped table-valign-middle">
          <thead class="thead-dark">
          <tr>
          <th class="text-center">ลำดับ</th>
          <th class="text-center">วันที่ซื้อ</th>
          <th class="text-center">ราคาซื้อ</th>
          <th class="text-center">ราคาต้นทุน</th>
          <th class="text-center">วันที่ขาย</th>
          <th class="text-center">ราคาขาย</th>
          <th class="text-center">ที่มา</th>
          </tr>
          </thead>';
          foreach($data as $key => $row){
            $SetKey = $key + 1;
            $create_date = date_create($row->create_date);
            $create_Soldout = date_create($row->Date_Soldout_plus);
            $SumPrice = $row->Fisrt_Price + $row->Repair_Price + $row->Offer_Price + $row->Color_Price + $row->Add_Price;

            if ($row->Origin_Car == 1) {
              $Type = 'CKL';
            }elseif ($row->Origin_Car == 2) {
              $Type = 'รถประมูล';
            }
            elseif ($row->Origin_Car == 3) {
              $Type = 'รถยึด';
            }
            elseif ($row->Origin_Car == 4) {
              $Type = 'ฝากขาย';
            }
            elseif ($row->Origin_Car == 5) {
              $Type = 'เทิร์นรถใหม่';
            }
            elseif ($row->Origin_Car == 6) {
              $Type = 'เทิร์นรถมือสอง';
            }
            elseif ($row->Origin_Car == 7) {
              $Type = 'ซื้อหน้าเต็นท์';
            }elseif ($row->Origin_Car == 8) {
              $Type = 'นายหน้า';
            }elseif ($row->Origin_Car == 9) {
              $Type = 'เทิร์นรถ GWM';
            }



            $output.='<tr>
            <td class="text-center">'.$SetKey.'</td>
            <td class="text-center">'.date_format($create_date, 'd-m-Y').'</td>
            <td class="text-center">'.number_format($row->Fisrt_Price, 2).'</td>
            <td class="text-center">'.number_format($SumPrice, 2).'</td>
            <td class="text-center">'.date_format($create_Soldout, 'd-m-Y').'</td>
            <td class="text-center">'.number_format($row->Net_Priceplus, 2).'</td>
            <td class="text-center">'.$Type.'</td>
            </tr>';
          }
          $output.='</table>';
          echo $output;
        }
        
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = DB::table('users')
        ->where('users.position','=', 'SALE')
        ->get();
        $type = $request->type;
        return view('homecar.create', compact('type','user'));
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if($request->type == 1){
        if($request->get('PriceCar') != Null){
          $SetPriceStr = str_replace (",","",$request->get('PriceCar'));
        }else{
          $SetPriceStr = Null;
        }

        if ($request->get('ReturnPrice') != Null) {
          $SetOfferStr = str_replace (",","",$request->get('ReturnPrice'));
        }else{
          $SetOfferStr = Null;
        }

        $SetDateCar = str_replace ("/","-",$request->get('DateCar'));
        $dateConvert0 = date_create($SetDateCar);
        $DateCar = date_format($dateConvert0, 'Y-m-d');

        // if($request->get('AccountingCost') != Null){
        //   $SetAccountingCost = str_replace (",","",$request->get('AccountingCost'));
        // }else{
        //   $SetAccountingCost = Null;
        // }
        if ($request->get('MilesCar') != Null) {
          $mile = str_replace (",","",$request->get('MilesCar'));
        }else{
         $mile = Null;
        }
        $datacardb = new data_car([
          'create_date' => $DateCar,
          'Fisrt_Price' => $SetPriceStr,
          'Return_Price' => $SetOfferStr,
          'Brand_Car' => $request->get('BrandCar'),
          'Chassis_car' => $request->get('Chassis_car'),
          'Version_Car' => $request->get('VersionCar'),
          'Number_Machine' => $request->get('Number_Machine'),
          'Model_Car' => $request->get('ModelCar'),
          'Number_Miles' =>  $mile,
          'Color_Car' => $request->get('ColorCar'),
          'Gearcar' => $request->get('Gearcar'),
          'Year_Product' => $request->get('YearCar'),
          'Size_Car' => $request->get('SizeCar'),
          'Number_Regist' => $request->get('Number_Regist'),
          'Job_Number' => $request->get('JobCar'),
          'Name_Sale' => $request->get('SaleCar'),
          'Origin_Car' => $request->get('OriginCar'),
          'Car_type' => $request->get('Cartype'),
          'Chassis_car' => $request->get('ChassisCar'),
          
          'Date_Status' => $DateCar,
          'Accounting_Cost' => $SetPriceStr,
        ]);
        $datacardb->save();

        if ($request->get('DateNumberUser') != "") {
          $SetDateNumberUser = $request->get('DateNumberUser');
        }elseif ($request->get('DateNumberUserHidden') != "") {
          $SetDateNumberUser = $request->get('DateNumberUserHidden');
        }
        else {
          $SetDateNumberUser = null;
        }
        if ($request->get('DateExpire') != "") {
          $SetDateExpire = $request->get('DateExpire');
        }elseif ($request->get('DateExpireHidden') != "") {
          $SetDateExpire = $request->get('DateExpireHidden');
        }
        else {
          $SetDateExpire = null;
        }
        $checkDoc = new checkDocument([
          'Datacar_id' => $datacardb->id,
          'PDI_220' => date('Y-m-d'),
          'Social' => date('Y-m-d'),
          'Contracts_Car' => $request->get('ContractsCar'),
          'Manual_Car' => $request->get('ManualCar'),
          'Act_Car' => $request->get('Act_Car'),
          'Insurance_Car' => $request->get('Insurance_Car'),
          'Key_Reserve' => $request->get('KeyReserve'),
          'Expire_Tax' => $request->get('ExpireTax'),
          'ChkCondition' => $request->get('ChkCondition'),
          'ChkTran' => $request->get('ChkTran'),
          'Name_CarUser'=>$request->get('NameCarUser'),
          'Certi_doc'=>$request->get('Certi_doc'),
          'Trans_doc'=>$request->get('Trans_doc'),
          'Id_doc'=>$request->get('Id_doc'),
          'Regist_car'=>$request->get('Regist_car'),
          'Regist_house'=>$request->get('Regist_house'),
          'Date_NumberUser' => $SetDateNumberUser,
          'Date_Expire' => $SetDateExpire,
          'Check_Note' => $request->get('CheckNote'),
        ]);
        $checkDoc->save();
        
        $type = 1;
        return redirect()->Route('datacar',$type)->with('success','บันทึกข้อมูลเรียบร้อย');
      }elseif($request->type == 2){
        $repairdb = new repair_part([
          'Datacar_id' => $request->get('Datacarid'),
          'Repair_date' => date('Y-m-d'),
          'Repair_list' => $request->get('RepairList'),
          'Repair_amount' => $request->get('RepairAmount'),
          'Repair_price' => $request->get('RepairPrice'),
          'Repair_useradd' => $request->get('Nameuser'),
        ]);
        $repairdb->save();
        return redirect()->back()->with('success','เพิ่มข้อมูลเรียบร้อย');
      }elseif($request->type == 3){
        $datacardb = new data_car([
          'Number_Regist' => $request->get('Number_Regist'),
          'Brand_Car' => $request->get('BrandCar'),
          'Model_Car' => $request->get('ModelCar'),
          'Version_Car' => $request->get('VersionCar'),
          'Expected_Repair' => $request->get('ExpectRepair'),
          'Expected_Color' => $request->get('ExpectColor'),
          'Car_type' => 3,
        ]);
        $datacardb->save();
        $checkDoc = new checkDocument([
          'Datacar_id' => $datacardb->id,
        ]);
        $checkDoc->save();
        return redirect()->Route('datacar',100)->with('success','บันทึกข้อมูลเรียบร้อย');
      }elseif($request->type == 6){
        if($request->id_expen==NULL){
          $dataExpen  = new data_expenses;
          $dataExpen->Car_id = $request->Car_id ;
        }else{
          $dataExpen  = data_expenses::where('id',$request->id_expen)->first();
        }
        
        $dataExpen->date_bill = $request->date_bill;
        $dataExpen->type_expen =  $request->type_expen ;
        $dataExpen->text_expen =  $request->text_expen ;
        $dataExpen->price =  $request->price ;
        $dataExpen->remark =  $request->remark ;
        $dataExpen->save();
        $flag = 'success';
        $data = data_car::where('id',$request->Car_id)->first();
        $id = $request->Car_id;
        $type = $request->type;
        $returnHTML = view('homecar.viewTagPart', compact('data','type','id'))->render();
        return response()->json(['flag'=>$flag,'html'=>$returnHTML]);
      }

  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Savestore(Request $request, $SetStr1, $SetStr2, $type)
    {
     if($type == 1){
      date_default_timezone_set('Asia/Bangkok');
      $Y = date('Y');
      $m = date('m');
      $d = date('d');
      $datethai = $Y.'-'.$m.'-'.$d;
      $SetStrConn = $SetStr1."/".$SetStr2;

      $data =  DB::connection('sqlsrv2')->table('holdcars')
      ->where('holdcars.Contno_hold', '=', $SetStrConn)
      ->orderBy('holdcars.Date_hold', 'ASC')
      ->first();
      
      $datacardb = new data_car([
        'create_date' => $datethai,
        'Brand_Car' => $data->Brandcar_hold,
        'Year_Product' => $data->Year_Product,
        'Number_Regist' => $data->Number_Regist,
          'Origin_Car' => 3, //ประเภทรถยึด
          'Car_type' => 1, //สถานะนำเข้าใหม่
          'Date_Status' => $datethai,
        ]);
      $datacardb->save();

      $checkDoc = new checkDocument([
        'Datacar_id' => $datacardb->id,
      ]);
      $checkDoc->save();
      return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
    }
  }
     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show(Request $request,$id)
     {
      if($request->type == 1){
        $data = DB::table('repair_parts')->where('Datacar_id',$id)->get();
        $datacar = DB::table('data_cars')->where('id',$id)->first();
        $SetTopic = "Receiptrepair ".date('Y-m-d');
        $view = \View::make('homecar.receiptRepair' ,compact('data','datacar','type'));
        $html = $view->render();
        $pdf = new PDF();
        $pdf::SetTitle('รายการซ่อมรถยนต์');
        $pdf::AddPage('L', 'A5');
        $pdf::SetMargins(15, 5, 15);
        $pdf::SetFont('freeserif', '', 16, '', true);
        $pdf::SetAutoPageBreak(TRUE, 21);
        $pdf::WriteHTML($html,true,false,true,false,'');
        $pdf::Output($SetTopic.'.pdf');

      }
      elseif($request->type == 2){
        $type=$request->type ;
        $data = DB::table('data_expenses')->where('id',$id)->first();
        $datacar = DB::table('data_cars')->where('id',$request->car_id)->first();
        $SetTopic = "Receiptrepair ".date('Y-m-d');
        $view = \View::make('homecar.reportPayments' ,compact('data','datacar','type'));
        $html = $view->render();
        $pdf = new PDF();
        $pdf::SetTitle('รายการซ่อมรถยนต์');
        $pdf::AddPage('P', 'A4');
        $pdf::SetMargins(15, 5, 5, 15);
        $pdf::SetFont('freeserif', '', 12, '', true);
        $pdf::SetAutoPageBreak(TRUE, 21);
        $pdf::WriteHTML($html,true,false,true,false,'');
        $pdf::Output($SetTopic.'.pdf');

      }
      elseif($request->type == 6){
        $Car_id = $request->Car_id;
        $type = $request->type ;
        return view('homecar.createTagService', compact('type','Car_id'));
      }
      elseif($request->type == 7){
        $Car_id = $request->Car_id;
        $type = $request->type ;
        $data = data_expenses::where('id',$id)->first();
        
        return view('homecar.createTagService', compact('type','Car_id','data'));
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request ,$id, $car_type)
    {
      $data = data_car::where('id',$id)->first();
      $datacar = DB::table('data_cars')
      ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
      ->leftJoin('data_customers','data_cars.id','=','data_customers.Datacar_id')
      ->where('data_cars.id',$id)
      ->first();

      $dataCarIn = DB::table('data_cars_ins')->where('Datacar_id',$id)->first();

      $dataImage = DB::table('uploadfile_images')
      ->where('Datacarfileimage_id',@$dataCarIn->id)
      //->where('ID_Carware',$id)
      ->get();

      $arrayCarType = [
        1 => 'รถยนต์นำเข้าใหม่',
        2 => 'รถยนต์ระหว่างทำสี',
        3 => 'รถยนต์รอซ่อม',
        4 => 'รถยนต์ระหว่างซ่อม',
        5 => 'รถยนต์พร้อมขาย',
        6 => 'รถยนต์ที่ขายแล้ว',
        7 => 'รถยนต์ส่งประมูล',
        8 => 'รถยนต์ระหว่างขนส่ง',
      ];
      
      $arrayOriginType = [
        1 => 'CKL',
        2 => 'รถประมูล',
        3 => 'รถยึด',
        4 => 'ฝากขาย',
        5 => 'เทิร์นรถใหม่',
        6 => 'เทิร์นรถมือสอง',
        7 => 'ซื้อหน้าเต็นท์',
        8 => 'นายหน้า',
        9 => 'เทิร์นรถ GWM',
      ];
      $arrayGearcar = [
        'MT' => 'MT',
        'AT' => 'AT',
      ];
      $arrayBrand = [
        'TOYOTA' => 'TOYOTA',
        'MAZDA' => 'MAZDA',
        'NISSAN' => 'NISSAN',
        'FORD' => 'FORD',
        'MITSUBISHI' => 'MITSUBISHI',
        'ISUZU' => 'ISUZU',
        'HONDA' => 'HONDA',
        'CHEVROLET' => 'CHEVROLET',
        'SUZUKI' => 'SUZUKI',
        'MG' => 'MG',
      ];
      $arrayModel = [
        ' ' => ' ',
        'กระบะตอนเดียว' => 'กระบะตอนเดียว',
        'กระบะตอนเดียวโฟรวิล' => 'กระบะตอนเดียวโฟรวิล',
        'กระบะตอนครึ่ง' => 'กระบะตอนครึ่ง',
        'กระบะตอนครึ่งยกสูง' => 'กระบะตอนครึ่งยกสูง',
        'กระบะสี่ประตู' => 'กระบะสี่ประตู',
        'กระบะสี่ประตูยกสูง' => 'กระบะสี่ประตูยกสูง',
        'เก๋ง' => 'เก๋ง',
        'MPV' => 'MPV',
        'Van' => 'Van',
        'SUV' => 'SUV',
      ];
      
      $arrayTypeSale = [
        'ประมูล' => 'ประมูล',
        'ขายตัด' => 'ขายตัด',
        'ขายสด' => 'ขายสด',
        'ขายผ่อน' => 'ขายผ่อน',
      ];
      $arrayBorrowStatus = [
        NULL => '',
        1 => 'ยืม',
        2 => 'คืนแล้ว',
      ];
      $user = DB::table('users')
      ->where('users.position','=', 'SALE')
      ->orwhere('users.position','=', 'Tradein')
      ->get();
      $setcarType = $car_type;
      $reserch = $request->get('reserch');

      $track_in = tracking_cars::where('id_cars',$id)->get();


      if($car_type == 6) {

        if($request->get('editbuy')== 0 ) {
         return view('homecar.edit',compact('datacar','user','id','arrayCarType','arrayOriginType','arrayGearcar','arrayBrand','arrayModel','arrayBorrowStatus','dataImage','track_in','data'));
       }else{
        return view('homecar.buyinfo',compact('datacar','user','id','arrayCarType','setcarType', 'arrayTypeSale','arrayBorrowStatus','dataImage','reserch'));
        
      }

    }
    elseif($car_type == 100){
      $dataRepair = DB::table('repair_parts')->where('Datacar_id',$id)->get();
      return view('mechanic.editRepair',compact('datacar','id','arrayCarType','arrayOriginType','arrayGearcar','arrayBrand','arrayModel','arrayBorrowStatus','dataRepair'));
    }
    elseif($car_type == 10) {
      return view('homecar.calculate',compact('datacar'));
    }
    else {
      return view('homecar.edit',compact('datacar','user','id','arrayCarType','arrayOriginType','arrayGearcar','arrayBrand','arrayModel','arrayBorrowStatus','dataImage','track_in','data'));
    }


  }

  public function viewsee(Request $request, $id, $car_type)
  {
    $datacar = DB::table('data_cars')
    ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
    ->where('data_cars.id',$id)->first();
      // dd($datacar);
    $title = '';
    $arrayCarType = [
      1 => 'รถยนต์นำเข้าใหม่',
      2 => 'รถยนต์ระหว่างทำสี',
      3 => 'รถยนต์รอซ่อม',
      4 => 'รถยนต์ระหว่างซ่อม',
      5 => 'รถยนต์พร้อมขาย',
      6 => 'รถยนต์ที่ขายแล้ว',
      7 => 'รถยนต์ส่งประมูล',

    ];
    $arrayOriginType = [
      1 => 'CKL',
      2 => 'รถประมูล',
      3 => 'รถยึด',
      4 => 'ฝากขาย',
      5 => 'เทิร์นรถใหม่',
      6 => 'เทิร์นรถมือสอง',
      7 => 'ซื้อหน้าเต็นท์',
      8 => 'นายหน้า',
      9 => 'เทิร์นรถ GWM',
    ];
    $arrayGearcar = [
      'MT' => 'MT',
      'AT' => 'AT',
    ];
    $arrayBrand = [
      'TOYOTA' => 'TOYOTA',
      'MAZDA' => 'MAZDA',
      'NISSAN' => 'NISSAN',
      'FORD' => 'FORD',
      'MITSUBISHI' => 'MITSUBISHI',
      'ISUZU' => 'ISUZU',
      'HONDA' => 'HONDA',
      'CHEVROLET' => 'CHEVROLET',
      'SUZUKI' => 'SUZUKI',
      'MG' => 'MG',
    ];

    $arrayModel = [
      ' ' => ' ',
      'กระบะตอนเดียว' => 'กระบะตอนเดียว',
      'กระบะตอนเดียวโฟรวิล' => 'กระบะตอนเดียวโฟรวิล',
      'กระบะตอนครึ่ง' => 'กระบะตอนครึ่ง',
      'กระบะตอนครึ่งยกสูง' => 'กระบะตอนครึ่งยกสูง',
      'กระบะสี่ประตู' => 'กระบะสี่ประตู',
      'กระบะสี่ประตูยกสูง' => 'กระบะสี่ประตูยกสูง',
      'เก๋ง' => 'เก๋ง',
      'MPV' => 'MPV',
      'Van' => 'Van',
      'SUV' => 'SUV',
    ];
    $arrayTypeSale = [
      'ประมูล' => 'ประมูล',
      'ขายตัด' => 'ขายตัด',
      'ขายสด' => 'ขายสด',
      'ขายผ่อน' => 'ขายผ่อน',
    ];
    $arrayBorrowStatus = [
      NULL => '',
      1 => 'ยืม',
      2 => 'คืนแล้ว',
    ];
    $setcarType = $car_type;
    return view('homecar.viewsee',compact('datacar','id','arrayCarType','arrayOriginType','arrayGearcar','arrayBrand','arrayModel','setcarType', 'arrayTypeSale','arrayBorrowStatus'));
  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if($request->get('RepairCar') != Null){
        $SetRepairStr = str_replace (",","",$request->get('RepairCar'));
      }else{
        $SetRepairStr = Null;
      }
      if($request->get('NetCar') != Null){
        $SetNetStr = str_replace (",","",$request->get('NetCar'));
      }else{
        $SetNetStr = Null;
      }
      if($request->get('PriceCar') != Null){
        $SetPriceStr = str_replace (",","",$request->get('PriceCar'));
      }else{
        $SetPriceStr = Null;
      }
      if($request->get('MilesCar') != Null){
        $SetMilesCar = str_replace (",","",$request->get('MilesCar'));
      }else{
        $SetMilesCar = Null;
      }
      // if($request->get('AccountingCost') != Null){
      //   $SetAccountingCost = str_replace (",","",$request->get('AccountingCost'));
      // }else{
      //   $SetAccountingCost = Null;
      // }
      if($request->get('AddPrice') != Null){
        $SetAddPriceStr = str_replace (",","",$request->get('AddPrice'));
      }else{
        $SetAddPriceStr = Null;
      }
      // if($request->get('OfferPrice') != Null){
      //   $SetOfferStr = str_replace (",","",$request->get('OfferPrice'));
      // }else{
      //   $SetOfferStr = Null;
      // }
      if($request->get('ColorPrice') != Null){
        $SetColorStr = str_replace (",","",$request->get('ColorPrice'));
      }else{
        $SetColorStr = Null;
      }
      if($request->get('Open_auction') != Null){
        $SetOpen_auction = str_replace (",","",$request->get('Open_auction'));
      }else{
        $SetOpen_auction = Null;
      }
      if($request->get('Close_auction') != Null){
        $SetClose_auction = str_replace (",","",$request->get('Close_auction'));
      }else{
        $SetClose_auction = Null;
      }
      if($request->get('Expected_Sell') != Null){
        $SetExpected_Sell = str_replace (",","",$request->get('Expected_Sell'));
      }else{
        $SetExpected_Sell = Null;
      }
      if($request->get('Expected_Sell') != Null){
        $SetExpected_Sell = str_replace (",","",$request->get('Expected_Sell'));
      }else{
        $SetExpected_Sell = Null;
      }

      $user = data_car::find($id);
      $user->create_date = $request->get('DateCar');
      $user->Fisrt_Price = $SetPriceStr;
      $user->Repair_Price = $SetRepairStr;
      $user->Net_Price = $SetNetStr;
      $user->Brand_Car = $request->get('BrandCar');
      $user->Version_Car = $request->get('VersionCar');
      $user->Model_Car = $request->get('ModelCar');
      $user->Number_Miles = $SetMilesCar;
      $user->Color_Car = $request->get('ColorCar');
      $user->Gearcar = $request->get('Gearcar');
      $user->Year_Product = $request->get('YearCar');
      $user->Size_Car = $request->get('SizeCar');
      $user->Number_Regist = $request->get('Number_Regist');
      $user->Chassis_car = $request->get('ChassisCar');
      $user->Job_Number = $request->get('JobCar');
      $user->Accounting_Cost = $SetPriceStr;
      $user->Name_Sale = $request->get('SaleCar');
      $user->Origin_Car = $request->get('OriginCar');
      $user->Add_Price = $SetAddPriceStr;
      // $user->Offer_Price = $SetOfferStr;
      $user->Type_buy = $request->get('Type_buy');
      $user->claim_MMTH = $request->get('claim_MMTH');
      $user->Repair_Remark = $request->get('RepairRemark');
      $user->car_link = $request->get('car_link');
      $user->Add_Remark = $request->get('AddRemark');
      $user->Comsale_turn = str_replace (",","",$request->get('Comsale_turn'));
      $user->com_sale = str_replace (",","",$request->get('com_sale'));
      $user->Budget_Gift = str_replace (",","",$request->get('Budget_Gift'));
      $user->Color_Remark = $request->get('ColorRemark');
      $user->Insur_Price = str_replace (",","",$request->get('InsurPrice'));
      $user->Tran_Fee = str_replace (",","",$request->get('TranFee'));
      $user->Cost_Insur = str_replace (",","",$request->get('CostInsur'));
      $user->Return_Price = str_replace (",","",$request->get('ReturnPrice'));
      $user->Date_Borrowcar = $request->get('DateBorrowcar');
      $user->Date_Returncar = $request->get('DateReturncar');
      $user->Name_Borrow = $request->get('NameBorrow');
      $user->Margin_allocation = $request->get('Margin_allocation');
      $user->Vat_car_buy = $request->get('Vat_car_buy');
      $user->Balance_Budget = $request->get('Balance_Budget');
      $user->Vat_car_sale = $request->get('Vat_car_sale');
      $user->Note_Borrow = $request->get('NoteBorrow');
      $user->BorrowStatus = $request->get('BorrowStatus');
      $user->Expected_Repair = str_replace (",","",$request->get('ExpectedRepair'));
      $user->Expected_Color = str_replace (",","",$request->get('ExpectedColor'));
      
      $user->Color_Price = $SetColorStr;
      if ($request->get('Cartype') != Null && $request->get('Cartype') != $user->Car_type ) {
        date_default_timezone_set('Asia/Bangkok');
        $Y = date('Y');
        $m = date('m');
        $d = date('d');
        $date = $Y.'-'.$m.'-'.$d;
        if ($request->get('Cartype') == 2) {
          $user->Date_Color = $date;
          $user->Date_Status = $date;
        }elseif ($request->get('Cartype') == 3) {
          $user->Date_Wait = $date;
          $user->Date_Status = $date;
        }elseif ($request->get('Cartype') == 4) {
          $user->Date_Repair = $date;
          $user->Date_Status = $date;
        }elseif ($request->get('Cartype') == 5) {
          $user->Date_Sale = $date;
          $user->Date_Status = $date;
        }elseif ($request->get('Cartype') == 6) {
          $user->Date_Soldout = $date;
          $user->Date_Status = $date;
        }elseif ($request->get('Cartype') == 7) {
          $user->Date_Auction = $date;
          $user->Date_Status = $date;
        }elseif ($request->get('Cartype') == 8) {
          $user->Date_Carry = $date;
          $user->Date_Status = $date;
        }
      }
      
      
      $user->Car_type = $request->get('Cartype');
      $user->Open_auction = $SetOpen_auction;
      $user->Close_auction = $SetClose_auction;
      $user->Expected_Sell = $SetExpected_Sell;
      $user->Price_Thana = str_replace (",","",$request->get('Price_Thana'));
        //$user->Price_NonThana = str_replace (",","",$request->get('Price_NonThana'));
      $user->Price_Tisco = str_replace (",","",$request->get('Price_Tisco'));
        //$user->Price_NonTisco = str_replace (",","",$request->get('Price_NonTisco'));
      $user->Price_Scb = str_replace (",","",$request->get('Price_Scb'));
        //$user->Price_NonScb = str_replace (",","",$request->get('Price_NonScb'));
      $user->Price_AY = str_replace (",","",$request->get('Price_AY'));
       // $user->Price_NonAY = str_replace (",","",$request->get('Price_NonAY'));
      $user->Price_Choo = str_replace (",","",$request->get('Price_Choo'));
      $user->Price_Kiatnakin = str_replace (",","",$request->get('Price_Kiatnakin'));
      $user->Price_KLeasing = str_replace (",","",$request->get('Price_KLeasing'));


      $user->update();

      $checkeditDoc = checkDocument::where('Datacar_id',$id)->first();
      $checkeditDoc->Name_CarUser = $request->get('NameCarUser');
      $checkeditDoc->PDI_220 = $request->get('PDI_220');
      $checkeditDoc->PDS = $request->get('PDS');
      $checkeditDoc->Social = $request->get('Social');
      $checkeditDoc->Contracts_Car = $request->get('ContractsCar');
      $checkeditDoc->Manual_Car = $request->get('ManualCar');
      $checkeditDoc->Act_Car = $request->get('Act_Car');
      $checkeditDoc->Insurance_Car = $request->get('Insurance_Car');
      $checkeditDoc->Key_Reserve = $request->get('KeyReserve');
      $checkeditDoc->Check_Note = $request->get('CheckNote');
      $checkeditDoc->Certi_doc= $request->get('Certi_doc');
      $checkeditDoc->Trans_doc=$request->get('Trans_doc');
      $checkeditDoc->Id_doc = $request->get('Id_doc');
      $checkeditDoc->Regist_car = $request->get('Regist_car');
      $checkeditDoc->Regist_house = $request->get('Regist_house');
      $checkeditDoc->ChkCondition = $request->get('ChkCondition');
      $checkeditDoc->ChkTran = $request->get('ChkTran');
      if ($request->get('DateNumberUser') != "") {
        $SetDateNumberUser = $request->get('DateNumberUser');
      }elseif ($request->get('DateNumberUserHidden') != "") {
        $SetDateNumberUser = $request->get('DateNumberUserHidden');
      }
      else {
        $SetDateNumberUser = null;
      }
      if ($request->get('DateExpire') != "") {
        $SetDateExpire = $request->get('DateExpire');
      }elseif ($request->get('DateExpireHidden') != "") {
        $SetDateExpire = $request->get('DateExpireHidden');
      }
      else {
        $SetDateExpire = null;
      }
      $checkeditDoc->Date_NumberUser = $SetDateNumberUser;
      $checkeditDoc->Date_Expire = $SetDateExpire;
      $checkeditDoc->Expire_Tax = $request->get('ExpireTax');

      if ($request->hasFile('file_doc')) {

        $path = public_path().'/upload-image/'.$id.'/doc';
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        $doc_array = $request->file('file_doc');
        $countdocin = explode(',',$checkeditDoc->Doc_file);
        
        if(count($countdocin)>0){
          $start = count($countdocin)-1;
        }else{
          $start = 0;
        }
        $array_len = count($doc_array)+$start;
        
        $nameFile = "";

        for ($i=$start; $i < $array_len; $i++) {
         
          $doc_size = $doc_array[$i-$start]->getClientSize();
          $doc_new_name = 'doc'.$i.'.'.$doc_array[$i-$start]->getClientOriginalExtension();

          $doc_array[$i-$start]->move($path,$doc_new_name);
          $nameFile .=$doc_new_name."," ;
        }
        $checkeditDoc->Doc_file =  $checkeditDoc->Doc_file.','.$nameFile;

      }
      if ($request->hasFile('file_doc2')) {

        $path = public_path().'/upload-image/'.$id.'/doc';
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        $doc_array2 = $request->file('file_doc2');
         $countdocin2 = explode(',',$checkeditDoc->Doc_file2);
         if(count($countdocin2)>0){
          $start2 = count($countdocin2)-1;
        }else{
          $start2 = 0;
        }
        $array_len2 = count($doc_array2)+$start2;
        
        $nameFile2 = "";
        
        for ($i=$start2; $i < $array_len2; $i++) {
          $doc_size = $doc_array2[$i-$start2]->getClientSize();
          $doc_new_name = 'doc2'.$i.'.'.$doc_array2[$i-$start2]->getClientOriginalExtension();

          $doc_array2[$i-$start2]->move($path,$doc_new_name);
          $nameFile2 .=$doc_new_name."," ;
        }
        $checkeditDoc->Doc_file2 = $checkeditDoc->Doc_file2.','.$nameFile2;

      }

      $checkeditDoc->update();

      if ($request->hasFile('file_image')) {


        $dataImage = UploadfileImage::where('ID_Carware',$id)->count();
        if($dataImage==0){
          $dataImage = 1;
        }else{
          $dataImage =$dataImage;
        }
        $Image = UploadfileImage::where('ID_Carware',$id)->count();
        if($Image->Datacarfileimage_id!=null && $Image->Type_fileimage==2){
          $path_id =$Image->Datacarfileimage_id;
        }else{
          $path_id = $Image->ID_Carware;
        }
        $path = public_path().'/upload-image/'.$path_id;
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        $image_array = $request->file('file_image');
        $array_len = count($image_array);

        for ($i=0; $i < $array_len; $i++) {


          $image_size = $image_array[$i]->getClientSize();

          $filename    = $image_array[$i]->getClientOriginalName();
          $image_resize = Image::make($image_array[$i]->getRealPath());              

          $image_resize->resize(900, 900, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
          });

          $image_new_name = $request->get('Number_Regist').($dataImage++).'.'.$image_array[$i]->getClientOriginalExtension();

         
          $destination_path = public_path().'/upload-image/'.$path_id;


          $image_resize->save($destination_path.'/'.$image_new_name);

          // $dataImage = UploadfileImage::where('ID_Carware',$id)->first();
          
          $Uploaddb = new UploadfileImage([
            'ID_Carware' => $id,
            'Datacarfileimage_id' => $Image->Datacarfileimage_id,
            'Type_fileimage' => 2,
            'Name_fileimage' => $image_new_name,
            'Size_fileimage' => $image_size,
          ]);
          $Uploaddb ->save();
           
        }
      }
      

    
      if ($user->Car_type == '1') {
        $type = 7;
      }
      elseif ($user->Car_type == '7') {
        $type = 14;
      }elseif($request->type == '44'){
        $type = 44;
        $user->Repair_Price = $request->get('Totalprice');
        $user->update();
        return redirect()->back()->with('success','อัพเดตข้อมูลเรียบร้อย');
      }else {
        $type = $user->Car_type;  //Get ค่าใหม่
      }
      //return redirect()->Route('datacar.edit',[$id,$type])->with('success','อัพเดตข้อมูลเรียบร้อย');
      return redirect()->back()->with('success','อัพเดตข้อมูลเรียบร้อย');
    }
    public function trackingCars(Request $request,$id,$type,$type2){


      if ($type2 == 15) {   // view createTracking
       $type = 1;

       return view('homecar.createTracking', compact('id','type','type2'));
     }elseif($type2 == 16){
        //   $tracking = DB::table('tracking_cars')
        // ->where('tracking_cars.id','=',$id)
        // ->get();
      $tracking = tracking_cars::where('id',$id)->first();
      $type = 2;
      return view('homecar.editTracking', compact('id','type','type2','tracking'));
    }


      if ($type == 1) {       //เพิ่ม รายการ Tracking

        $dataTrack = new tracking_cars([
          'id_cars' => $id,
          'track_date' => $request->get('track_date'),
          'status_car' => $request->get('status_car'),
          'detail_car' => $request->get('detail_car'),
          'end_date' => $request->get('end_date'),
        ]);
        $dataTrack->save();

        return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
      }
        elseif ($type == 2) {       //แก้ไข รายการ Tracking
          $dataTrack = tracking_cars::find($id);
          $dataTrack->track_date = $request->get('track_date');
          $dataTrack->status_car = $request->get('status_car');
          $dataTrack->detail_car = $request->get('detail_car');
          $dataTrack->end_date =  $request->get('end_date');
          $dataTrack->update();
          return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
        }
      }
      public function updateinfo(Request $request, $id)
      {
        $user = data_car::find($id);
        $user->Date_Soldout_plus = $request->get('DateSoldoutplus');
        $user->Date_Withdraw = $request->get('DateWithdraw');


        if($request->get('NetPriceplus') != "") {
          $SetNetPriceplus = str_replace (",","",$request->get('NetPriceplus'));
          $user->Net_Priceplus = $SetNetPriceplus;
        }
        else{
          $user->Net_Priceplus = 0;
        }

        if($request->get('AmountPrice') != "") {
          $SetAmountPrice = str_replace (",","",$request->get('AmountPrice'));
          $user->Amount_Price = $SetAmountPrice;
        }
        else{
          $user->Amount_Price = 0;
        }

        $gift = $request->input('gift');
        if($gift!=''){
          $data_gift = implode(',', $gift);
        }else{
          $data_gift=NULL;
        }
      // echo $data_gift;
      // exit();
        $user->Name_Saleplus = $request->get('NameSaleplus');
        $user->Type_Sale = $request->get('TypeSale');
        $user->Name_Agent = $request->get('NameAgent');
        $user->Name_Buyer = $request->get('NameBuyer');
        $user->Tel_Buyer = $request->get('PhoneCus');
        $user->Type_Ofsale = $request->get('Type_Ofsale');

        if($request->get('IntroPrice') != "") {
         $user->Intro_Price = str_replace (",","",$request->get('IntroPrice'));
       }
       else{
         $user->Intro_Price  = 0;
       }

       $user->Finance_Name = $request->get('FinanceName');

       if($request->get('SpecialPrice') != "") {
         $user->Special_Price = str_replace (",","",$request->get('SpecialPrice'));
       }
       else{
        $user->Special_Price  = 0;
      }
      
      $user->Finance_Instal = $request->get('FinanceInstal');
      if($request->get('SpecialPrice') != "") {
        $user->Liger_Price = str_replace (",","",$request->get('LigerPrice'));
      }
      else{
        $user->Liger_Price = 0;
      }

      $user->Increase = $request->get('Increase');

      if($request->get('Month_Balance') != "") {
        $user->Month_Balance = str_replace (",","",$request->get('Month_Balance'));
      }
      else{
        $user->Month_Balance = 0;
      }
      if($request->get('DownPrice') != "") {
        $user->Down_Price = str_replace (",","",$request->get('DownPrice'));
      }
      else{
        $user->Down_Price = 0;
      }
      if($request->get('TransferPrice') != "") {
        $user->Transfer_Price = str_replace (",","",$request->get('TransferPrice'));
      }
      else{
        $user->Transfer_Price = 0;
      }
      if($request->get('SubdownPrice') != "") {
        $user->Subdown_Price = str_replace (",","",$request->get('SubdownPrice'));
      }
      else{
        $user->Subdown_Price = 0;
      }
      if($request->get('InsurancePrice') != "") {
       $user->Insurance_Price = str_replace (",","",$request->get('InsurancePrice'));
     }
     else{
      $user->Insurance_Price = 0;
    }
    if($request->get('TopcarPrice') != "") {
     $user->Topcar_Price = str_replace (",","",$request->get('TopcarPrice'));
   }
   else{
    $user->Topcar_Price = 0;
  }
  if($request->get('AmountPrice') != "") {
   $user->Amount_Price = str_replace (",","",$request->get('AmountPrice'));
 }
 else{
  $user->Amount_Price = 0;
}

if($request->get('comendFinance') != "") {
        $user->comendFinance = str_replace (",","",$request->get('comendFinance'));
      }
      else{
        $user->comendFinance = 0;
      }
       
    
$user->Date_invoice = $request->get('Date_invoice');
$user->Contract_Date = $request->get('Contract_Date');
$user->Po_Date = $request->get('Po_Date');
$user->FirmCase = $request->get('FirmCase');
$user->otherGift = $request->get('otherGift');
$user->oil_free = $request->get('oil_free');
$user->SendCar_Date = $request->get('SendCar_Date');
$user->Gift_Set = $data_gift;
$user->Car_type = $request->get('Cartype');
$user->Contract_Date = $request->get('Contract_Date');
$user->Remark_FN = $request->get('Remark_FN');
 $user->Vat_car_sale = $request->get('Vat_car_sale');
 $user->Margin_allocation = $request->get('Margin_allocation');
 $user->Balance_Budget = $request->get('Balance_Budget');

if($request->get('comendSale') != "") {
 $user->comendSale = str_replace (",","",$request->get('comendSale'));
}
else{
  $user->comendSale = 0;
}
if($request->get('comendAdmin') != "") {
 $user->comendAdmin =str_replace (",","",$request->get('comendAdmin'));
}
else{
  $user->comendAdmin = 0;
}

$user->update();
      $type = $user->Car_type;  //Get ค่าใหม่

      $cus_id = $user->F_DataCus_id;

      
      $cus = dataCustomer::where('DataCus_id',$cus_id)->first();
      if($cus){
        //$cus->Gift_Set = $data_gift;
        $cus->Phone_Cus = $request->get('PhoneCus');
        $cus->Send_date = $request->get('SendCar_Date');
        $cus->CashStatus_Cus = str_replace (",","",$request->get('CashStatus_Cus'));
        $cus->update();
      }

      return redirect()->Route('datacar',6)->with('success','อัพเดตข้อมูลเรียบร้อย');
    }
    public function deletePic(Request $request, $id)
    {
      if($request->type == 3 ){ //ลบรูปรถ

        $item3 = UploadfileImage::where('fileimage_id',$id)
        ->where('Type_fileimage',2)->first();
         // use File
        //echo $item3;
        if($item3->Datacarfileimage_id!=null && $item3->Type_fileimage==2){
          $path_id =$item3->Datacarfileimage_id;
        }else{
          $path_id = $item3->ID_Carware;
        }

        $file_path = public_path().'/upload-image/'.$path_id.'/'.$item3->Name_fileimage;
        if(file_exists($file_path)==true){
          unlink($file_path);
        }
        $item4 = UploadfileImage::where('fileimage_id',$id);
        $item4->Delete();
        
        return redirect()->Route('datacar.edit',[$path_id,1])->with('success','ลบข้อมูลเรียบร้อย');
      }else if($request->type == 4){
         $updatePic = checkDocument::where('Datacar_id',$id)->first();
         if($request->get('status')==1){
          $pic_arr = explode(',',$updatePic->Doc_file);
          $newPic = "";
          for($i=0;$i<count($pic_arr);$i++){
              if($pic_arr[$i]==$request->get('f_name')){
                continue;
              }
              if($pic_arr[$i]!=''){
                $newPic .=$pic_arr[$i].",";
              }
              
          }
         
           $updatePic->Doc_file= $newPic;
           $updatePic->update();
        }else if($request->get('status')==2){
           $pic_arr2 = explode(',',$updatePic->Doc_file2);
            $newPic2 = "";
            for($i=0;$i<count($pic_arr2);$i++){
              if($pic_arr2[$i]==$request->get('f_name')){
                continue;
              }
              if($pic_arr2[$i]!=''){
                $newPic2 .=$pic_arr2[$i].",";
              }
              
          }
        
           $updatePic->Doc_file= $newPic2;
           $updatePic->update();
        }
          

         
         $file_path = public_path().'/upload-image/'.$id.'/doc/'.$request->get('f_name');
        if(file_exists($file_path)==true){
          unlink($file_path);
        }
        return redirect()->Route('datacar.edit',[$id,6])->with('success','ลบข้อมูลเรียบร้อย');
      }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Request $request, $id)
    {
      if($request->type == 1){ //ลบรายการรถยนต์
        $item = data_car::find($id);
        $item2 = checkDocument::where('Datacar_id',$id);
        $item->Delete();
        $item2->Delete();
        return redirect()->back()->with('success','ลบข้อมูลเรียบร้อย');
      }elseif($request->type == 2){ //ลบรายการซ่อม
        $item = repair_part::find($id);
        $item->Delete();
        return redirect()->back()->with('success','ลบข้อมูลเรียบร้อย');
      }elseif($request->type == 3 ){ //ลบรูปรถ

        $item3 = UploadfileImage::where('fileimage_id',$id)
        ->where('Type_fileimage',2)->first();
         // use File
        //echo $item3;
        if($item3->Datacarfileimage_id!=null && $item3->Type_fileimage==2){
          $path_id =$item3->Datacarfileimage_id;
        }else{
          $path_id = $item3->ID_Carware;
        }
        $file_path = public_path().'/upload-image/'. $path_id.'/'.$item3->Name_fileimage;
        if(file_exists($file_path)==true){
          unlink($file_path);
        }
        $item4 = UploadfileImage::where('fileimage_id',$id);
        $item4->Delete();
        
        return redirect()->Route('datacar.edit',[$item3->ID_Carware,1])->with('success','ลบข้อมูลเรียบร้อย');
      }elseif($request->type == 6){
        if($request->id_expen!=NULL){          
          $dataExpen  = data_expenses::where('id',$request->id_expen)->first();
          $id = $dataExpen->Car_id;
          $dataExpen->delete();
        }     
        $type = $request->type;
        $flag = 'success';
        $data = data_car::where('id',$id)->first();
        $returnHTML = view('homecar.viewTagPart', compact('data','type','id'))->render();
        return response()->json(['flag'=>$flag,'html'=>$returnHTML]);
      }

     
    }
    public function uploadImg(Request $request){

      if ($request->hasFile('file_image')) {

        $path = public_path().'/upload-image/'.$request->path;
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        $image_array = $request->file('file_image');
        $array_len = count($image_array);

        for ($i=0; $i < $array_len; $i++) {
          $image_size = $image_array[$i]->getClientSize();
          $image_new_name = 'car'.$i.'.'.$image_array[$i]->getClientOriginalExtension();

          $destination_path = public_path().'/upload-image/'.$request->path;
          $image_array[$i]->move($destination_path,$image_new_name);

          $dataImage = UploadfileImage::where('Datacarfileimage_id',$id)->first();
          
          $Uploaddb = new UploadfileImage([
            'Datacarfileimage_id' => $request->id,
            'Type_fileimage' => 2,
            'Name_fileimage' => $image_new_name,
            'Size_fileimage' => $image_size,
          ]);
          $Uploaddb ->save();
          
        }
      }
     // return redirect()->Route('datacar.edit',[$request->id,1])->with('success','อัพเดตข้อมูลเรียบร้อย');
    }

    public function ReportPDFIndex(Request $request)
    {
      date_default_timezone_set('Asia/Bangkok');
      $Y = date('Y');
      $m = date('m');
      $d = date('d');
      $date = $d.'-'.$m.'-'.$Y;

      $fdate = '';
      $tdate = '';
      $report = '';
      $originType = '';
      
      if ($request->Fromdate != NULL) {
        $fdate = \Carbon\Carbon::parse($request->Fromdate)->format('Y')."-". \Carbon\Carbon::parse($request->Fromdate)->format('m')."-". \Carbon\Carbon::parse($request->Fromdate)->format('d');
      }
      if ($request->Todate != NULL) {
        $tdate = \Carbon\Carbon::parse($request->Todate)->format('Y')."-". \Carbon\Carbon::parse($request->Todate)->format('m')."-". \Carbon\Carbon::parse($request->Todate)->format('d');
      }
      // if ($request->typeCar != NULL) {
      //   $typeCar = $request->get('typeCar');
      // }
      // if ($request->originType != NULL) {
      //   $originType = $request->get('originType');
      // }

      $report = $request->get('report');
      $type = $request->get('type');
      if($report=='mgr'||$report=='sale'){
        return view('homecar.reportMGR' ,compact(['fdate','tdate','report','type']));
      }elseif($report=='track'){
        return view('homecar.reportTrack' ,compact(['fdate','tdate','report','type']));
      }elseif($report=='expen'){
        return view('homecar.reportExpen' ,compact(['fdate','tdate','report','type']));
      }

      // if ($request->type == 1 or $request->type == 2) {    //รายงานพนักงาน & ผู้บริหาร
      //   if ($typeCar == '6') {
      //     $dataReport = DB::table('data_cars')
      //         ->leftjoin('check_documents','data_cars.id','=','check_documents.Datacar_id')
      //         ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
      //           return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
      //         })
      //         ->when(!empty($typeCar), function($q) use($typeCar){
      //           return $q->where('data_cars.Car_type',$typeCar);
      //         })
      //         ->when(!empty($originType), function($q) use($originType){
      //           return $q->where('data_cars.Origin_Car',$originType);
      //         })
      //         ->orderBy('data_cars.create_date', 'ASC')
      //         ->get();
      //   }else {
      //     $dataReport = DB::table('data_cars')
      //         ->leftjoin('check_documents','data_cars.id','=','check_documents.Datacar_id')
      //         ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
      //           return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
      //         })
      //         ->when(!empty($typeCar), function($q) use($typeCar){
      //           return $q->where('data_cars.Car_type',$typeCar);
      //         })
      //         ->when(!empty($originType), function($q) use($originType){
      //           return $q->where('data_cars.Origin_Car',$originType);
      //         })
      //         ->where('data_cars.Car_type','!=',6)
      //         ->orderBy('data_cars.create_date', 'ASC')
      //         ->get();
      //   }

      //   if ($request->type == 1) {
      //     $AdminType = 1;   //พนักงาน
      //     $ReportType = 1;
      //   }
      //   elseif ($request->type == 2) {
      //     $AdminType = 2;   //ผู้บริหาร
      //     $ReportType = 1;
      //   }
      
      //   if ($typeCar == '1') {
      //     $txtType = 'รถนำเข้าใหม่';
      //   }elseif ($typeCar == '2') {
      //     $txtType = 'รถระหว่างทำสี';
      //   }elseif ($typeCar == '3') {
      //     $txtType = 'รถรอซ่อม';
      //   }elseif ($typeCar == '4') {
      //     $txtType = 'รถระหว่างซ่อม';
      //   }elseif ($typeCar == '5') {
      //     $txtType = 'รถพร้อมขาย';
      //   }elseif ($typeCar == '6') {
      //     $txtType = 'รถขายแล้ว';
      //   }elseif ($typeCar == '7') {
      //     $txtType = 'รถส่งประมูล';
      //   }else {
      //     $txtType = 'รถยนต์ทั้งหมด';
      //   }

      //   $txtorigin = '';
      //   if ($originType == '1') {
      //     $txtorigin = 'CKL';
      //   }elseif ($originType == '2') {
      //     $txtorigin = 'รถประมูล';
      //   }elseif ($originType == '3') {
      //     $txtorigin = 'รถยึด';
      //   }elseif ($originType == '4') {
      //     $txtorigin = 'รถฝากขาย';
      //   }
      
      //   $SetConn = "StockCAR ".$date;

      //   $view = \View::make('homecar.export' ,compact(['dataReport','ReportType', 'AdminType','fdate','tdate','txtType','txtorigin']));
      //   $html = $view->render();
      //   $pdf = new PDF();
      //   $pdf::SetTitle('รายการสต็อกรถยนต์');
      //   $pdf::AddPage('L', 'A4');
      //   // $pdf::SetFont('freeserif');
      //   $pdf::SetFont('freeserif', '', 15, '', true);
      //   $pdf::SetMargins(10, 5, 5, 5);
      //   $pdf::SetAutoPageBreak(TRUE, 25);
      //   $pdf::WriteHTML($html,true,false,true,false,'');
      //   $pdf::Output($SetConn.'.pdf');
      // }
      // elseif ($request->type == 3) { //รายงาน รถส่งประมูล
      //     $dataReport = DB::table('data_cars')
      //         ->where('data_cars.Car_type','=', 7)
      //         ->orderBy('data_cars.create_date', 'ASC')
      //         ->get();

      //     $ReportType = $request->type;

      //     $view = \View::make('homecar.export' ,compact(['dataReport','ReportType','fdate','tdate']));
      //     $html = $view->render();
      //     $pdf = new PDF();
      //     $pdf::SetTitle('รายการรถยนต์ส่งประมูล');
      //     $pdf::AddPage('L', 'A4');
      //     $pdf::SetFont('freeserif', '', 15, '', true);
      //     $pdf::SetMargins(10, 5, 5, 5);
      //     $pdf::SetAutoPageBreak(TRUE, 25);
      //     $pdf::WriteHTML($html,true,false,true,false,'');
      //     $pdf::Output('report.pdf');

      // }
    }

    public function ReportPDF(Request $request)
    {
      $dataReport = DB::table('data_cars')
      ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
      ->where('data_cars.Car_type','=',$request->id)
      ->orderBy('data_cars.create_date', 'ASC')->get();

      $ReportType = $request->id;
      $view = \View::make('homecar.export' ,compact(['dataReport','ReportType']));
      $html = $view->render();
      $pdf = new PDF();
      $pdf::SetTitle('รายการรถยนต์ พร้อมขาย');
      $pdf::AddPage('L', 'A4');
      $pdf::SetFont('freeserif');
      $pdf::WriteHTML($html,true,false,true,false,'');
      $pdf::Output('report.pdf');
    }
    
  }
