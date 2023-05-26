<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use PDF;
use Storage;
use File;

use App\data_cars_in;
use App\status_cars_in;
use App\data_car;
use App\checkDocument;
use App\UploadfileImage;
use Intervention\Image\ImageManagerStatic as Image;

class DataCarsInController extends Controller
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
      $user1 = null;
      if(auth()->user()->position == 'SALE'){
       $user1 = auth()->user()->username ;
     }
     if ($request->has('Fromdate')) {
      $fdate = $request->get('Fromdate');
    }
    if ($request->has('Todate')) {
      $tdate = $request->get('Todate');
    }
    if ($request->has('carType')) {
      $carType = $request->get('carType');
    }
    if ($request->get('Fromdate') or $request->get('Todate') != NULL){
      $fdate = \Carbon\Carbon::parse($fdate)->format('Y')."-". \Carbon\Carbon::parse($fdate)->format('m')."-". \Carbon\Carbon::parse($fdate)->format('d');
      $tdate = \Carbon\Carbon::parse($tdate)->format('Y')."-". \Carbon\Carbon::parse($tdate)->format('m')."-". \Carbon\Carbon::parse($tdate)->format('d');
    }
        if ($request->type == 1) {              //รถทั้งหมด


          if ($request->has('carType') != Null) {
            $data = DB::table('data_cars_ins')
            ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
              return $q->whereBetween('data_cars_ins.Date_Car_in',[$fdate,$tdate]);
            })
            ->when(!empty($carType), function($q) use($carType){
              return $q->where('data_cars_ins.Status_Car_in1',$carType);
            })
            ->when(!empty($user1), function($q) use($carType,$user1){
              return $q->where('data_cars_ins.Sale_Name',$user1);
            })
            ->orderBy('data_cars_ins.Date_Car_in', 'DESC')
            ->orderBy('data_cars_ins.Sale_Name', 'asc')
            ->get();

          }else {
            $data = DB::table('data_cars_ins')
            ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
              return $q->whereBetween('data_cars_ins.Date_Car_in',[$fdate,$tdate]);
            })
            ->when(!empty($user1), function($q) use($carType,$user1){
              return $q->where('data_cars_ins.Sale_Name',$user1);
            })
            ->orderBy('data_cars_ins.Date_Car_in', 'DESC')
            ->orderBy('data_cars_ins.Sale_Name', 'asc')
            ->get();
          }
          
          $fdate = $request->get('Fromdate');
          $tdate = $request->get('Todate');
          $title = 'รถยนต์ทั้งหมด';
        }
        elseif ($request->type == 2) {          //รถที่ผ่าน
          $data = DB::table('data_cars_ins')
          ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
            return $q->whereBetween('data_cars_ins.Date_Car_in',[$fdate,$tdate]);
          })
          ->leftjoin('status_cars_in','data_cars_ins.id','=','status_cars_in.id_car_in')
          ->whereNotNull('status_cars_in.Status_Car_in')
          ->where('data_cars_ins.Status_Car_in1','<>',4)
          ->orderBy('data_cars_ins.Date_Car_in', 'DESC')
          ->orderBy('data_cars_ins.Sale_Name', 'asc')
          ->get();
          $title = 'รถตรวจสอบเเล้ว';
        }
        elseif ($request->type == 3) {          //รถที่ผ่าน
          $data = DB::table('data_cars_ins')
          ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
            return $q->whereBetween('data_cars_ins.Date_Car_in',[$fdate,$tdate]);
          })
          ->leftjoin('status_cars_in','data_cars_ins.id','=','status_cars_in.id_car_in')
          ->where('status_cars_in.Status_Car_in','=','yes')
          ->orderBy('data_cars_ins.Date_Car_in', 'DESC')
          ->orderBy('data_cars_ins.Sale_Name', 'asc')
          ->get();
          $title = 'รถรอนำเข้า Car WareHouse';
        }
        
        
        $type = $request->type;
        return view('dataCars.view', compact('data','title','type','fdate','tdate','carType'));

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
      return view('dataCars.create', compact('type','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $SetDateCar = str_replace ("/","-",$request->get('Date_Car_in'));
      $dateConvert0 = date_create($SetDateCar);
      $DateCar = date_format($dateConvert0, 'Y-m-d');

      if($request->get('Cus_Need_price') != Null){
        $cusCarNeed = str_replace (",","",$request->get('Cus_Need_price'));
      }else{
        $cusCarNeed = Null;
      }


      $datacardb = new data_cars_in([
        'Date_Car_in' => $DateCar,
        'Nameid_Car_in' => $request->get('Nameid_Car_in'),
        'Brand_Car_in' => $request->get('Brand_Car_in'),
        'CarType_in' => $request->get('CarType_in'),
        'Model_Car_in' => $request->get('Model_Car_in'),
        'Version_Car_in' => $request->get('Version_Car_in'),
        'id_body_car'=> $request->get('id_body_car'),
        'Gear_Car_in' => $request->get('Gear_Car_in'),
        'Car_Year_in' => $request->get('Car_Year_in'),
        'Size_Car_in' => $request->get('Size_Car_in'),
        'Color_car_in' => $request->get('Color_car_in'),
        'Cus_Need_price' => $cusCarNeed,
        'Sale_Name' => $request->get('Sale_Name'),
        'Detail_Car_in' => $request->get('Detail_Car_in'),
        'Miles_Car_in' => $request->get('Miles_Car_in'),
        'StatusFN_Car_in' => $request->get('StatusFN_Car_in'),
        'Other_FN' => $request->get('name_finance'),
        'Name_Cus_Car' => $request->get('Name_Cus_Car'),
        'Name_Cus_in' => $request->get('Name_Cus_in'),
        'Nick_Cus_in' => $request->get('Nick_Cus_in'),
        'Tel_Cus_in' => $request->get('Tel_Cus_in'),
        'Status_Car_in1' => '1',
        'Return_car' => $request->get('Return_car'),
        
      ]);
      $datacardb->save();

      $status_in = new status_cars_in([
       'id_car_in'=> $datacardb->id,
     ]);
      $status_in->save();
      $type = 1;
      return redirect()->Route('datacarin',$type)->with('success','บันทึกข้อมูลเรียบร้อย');
    }
    public function viewsee(Request $request, $id, $car_type)
    {
      $datacar = DB::table('data_cars_ins')
      ->leftjoin('status_cars_in','data_cars_ins.id','=','status_cars_in.id_car_in')
      ->where('data_cars_ins.id',$id)->first();
      // dd($datacar);
      $title = '';
      $arrayCarType = [
        1 => 'รถยนต์เข้าใหม่',
        2 => 'รถยนต์ที่ตรวจสอบแล้ว',
        3 => 'รถยนต์ที่ผ่านรอรับเข้า',
        4 => 'รถนำเข้า Car WareHouse',
        
      ];
      $arrayOriginType = [
        1 => 'CKL',
        2 => 'รถประมูล',
        3 => 'รถยึด',
        4 => 'ฝากขาย',
        5 => 'เทิร์นรถใหม่',
        6 => 'เทิร์นรถมือสอง',
        7 => 'ซื้อหน้าเต็นท์',
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
       $dataImage = DB::table('uploadfile_images')
     ->where('Datacarfileimage_id',$id)
     ->where('Type_fileimage',1)
     ->get();
      
      $setcarType = $car_type;
      return view('dataCars.viewsee',compact('datacar','id','arrayCarType','arrayOriginType','arrayGearcar','arrayBrand','arrayModel','setcarType','dataImage'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\data_cars_in  $data_cars_in
     * @return \Illuminate\Http\Response
     */
    public function show(data_cars_in $data_cars_in)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\data_cars_in  $data_cars_in
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request ,$id, $type)
    {
     $datacar = DB::table('data_cars_ins')
     ->leftjoin('status_cars_in','data_cars_ins.id','=','status_cars_in.id_car_in')
     ->where('data_cars_ins.id',$id)->first();

     $dataImage = DB::table('uploadfile_images')
     ->where('Datacarfileimage_id',$id)
     ->where('Type_fileimage',1)
     ->get();
     $user = DB::table('users')
     ->where('users.position','=', 'SALE')
     ->get();
     return view('dataCars.edit',compact('datacar','id','dataImage','type','user'));

   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\data_cars_in  $data_cars_in
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     $SetDateCar = str_replace ("/","-",$request->get('Date_Car_in'));
     $dateConvert0 = date_create($SetDateCar);
     $DateCar = date_format($dateConvert0, 'Y-m-d');

     if($request->get('Cus_Need_price') != Null){
      $cusCarNeed = str_replace (",","",$request->get('Cus_Need_price'));
    }else{
      $cusCarNeed = Null;
    }

    
    if($request->get('Status_Car_in')!=''){

      if($request->get('Status_Car_in')=='yes'){
            if($request->get('Status_Car_in1')==4){
              $type2 = 4 ;
            }else{
                $type2 = 3 ;
            }       
     }else{
       $type2 = 2 ;
     }
     $type = 2 ;
   }else{
    $type = 1 ;
    $type2 = 1 ;
  }
  
  $todayBE = \Carbon\Carbon::now()->format('Y')."-". \Carbon\Carbon::now()->format('m')."-". \Carbon\Carbon::now()->format('d');


  $datacar = data_cars_in::find($id);
  $datacar->Nameid_Car_in = $request->get('Nameid_Car_in');
  $datacar->Date_Status_car =  $todayBE;
  $datacar->Brand_Car_in = $request->get('Brand_Car_in');
  $datacar->CarType_in = $request->get('CarType_in');
  $datacar->Model_Car_in = $request->get('Model_Car_in');
  $datacar->id_body_car = $request->get('id_body_car');
  $datacar->Version_Car_in = $request->get('Version_Car_in');
  $datacar->Gear_Car_in = $request->get('Gear_Car_in');
  $datacar->Car_Year_in = $request->get('Car_Year_in');
  $datacar->Size_Car_in = $request->get('Size_Car_in');
  $datacar->Color_car_in = $request->get('Color_car_in');
  $datacar->Cus_Need_price = $cusCarNeed;
  $datacar->Sale_Name = $request->get('Sale_Name');
  $datacar->Detail_Car_in = $request->get('Detail_Car_in');
  $datacar->Miles_Car_in = $request->get('Miles_Car_in');
  $datacar->StatusFN_Car_in = $request->get('StatusFN_Car_in');
  $datacar->DateFN = $request->get('DateFN');
  $datacar->TotalFN = $request->get('TotalFN');
  $datacar->Other_FN = $request->get('name_finance');
  $datacar->Name_Cus_Car = $request->get('Name_Cus_Car');
  $datacar->Name_Cus_in = $request->get('Name_Cus_in');
  $datacar->Nick_Cus_in = $request->get('Nick_Cus_in');
  $datacar->Tel_Cus_in = $request->get('Tel_Cus_in');
  $datacar->Date_Carry_in = $request->get('Date_Carry');
  $datacar->Return_car = $request->get('Return_car');
  $datacar->Return_new_car = $request->get('Return_new_car');
  $datacar->Status_Car_in1 = $type2;
  $datacar->update();

  $status_in = status_cars_in::where('id_car_in',$id)->first();
  $status_in->Look_Car_in = $request->get('Look_Car_in');
  $status_in->Price_head= $request->get('Price_head');
  $status_in->Price_Budget= $request->get('Price_Budget');
  $status_in->Comsale_in= $request->get('Comsale_in');
  $status_in->Type_Car_in= $request->get('Type_Car_in');
  $status_in->Status_Car_in= $request->get('Status_Car_in');
  $status_in->Status_Detail= $request->get('Status_Detail');
  $status_in->Remark= $request->get('Remark');
  $status_in->Date_See_Car= $request->get('Date_See_Car');
  $status_in->date_update = date('Y-m-d');
  $status_in->save();

  if ($request->hasFile('file_image')) {
   $path = public_path().'/upload-image/'.$id;
   File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

   
   $image_array = $request->file('file_image');
   $array_len = count($image_array);

   $dataImage = UploadfileImage::where('Datacarfileimage_id',$id)->count();
   if($dataImage==0){
    $dataImage = 1;
  }else{
    $dataImage =$dataImage;
  }
  for ($i=0; $i < $array_len; $i++) {


    $image_size = $image_array[$i]->getClientSize();

    $filename    = $image_array[$i]->getClientOriginalName();
     $image_resize = Image::make($image_array[$i]->getRealPath());              
  
    $image_resize->resize(900, 900, function ($constraint) {
    $constraint->aspectRatio();
    $constraint->upsize();
});

    $image_new_name = $request->get('Nameid_Car_in').$dataImage.'.'.$image_array[$i]->getClientOriginalExtension();

    $dataImage++;
    $destination_path = public_path().'/upload-image/'.$id;


   
    
    $image_resize->save($destination_path.'/'.$image_new_name);

    //$image_array[$i]->move($destination_path,$image_new_name);

    
          // if($dataImage == ''){
    $Uploaddb = new UploadfileImage([
      'Datacarfileimage_id' => $id,
      'Type_fileimage' => 1,
      'Name_fileimage' => $image_new_name,
      'Size_fileimage' => $image_size,
    ]);
    $Uploaddb ->save();
          // }else{
          //   $dataImage->Name_fileimage = $image_new_name;
          //   $dataImage->Size_fileimage = $image_size;
          //   $dataImage->update();
          // }
  }
}
return redirect()->Route('datacarin.edit',[$id,1])->with('success','บันทึกข้อมูลเรียบร้อย');

}
public function deletePic(Request $request, $id){
      if($request->type == 2){ //ลบรูปภาพ
        $item3 = UploadfileImage::where('fileimage_id',$id)->first();
         // use File
        //echo $item3;
        $file_path = public_path().'/upload-image/'.$item3->Datacarfileimage_id.'/'.$item3->Name_fileimage;
        if(file_exists($file_path)==true){
          unlink($file_path);
        }
        $item4 = UploadfileImage::where('fileimage_id',$id);
        $item4->Delete();
        
        return redirect()->Route('datacarin.edit',[$item3->Datacarfileimage_id,1])->with('success','ลบข้อมูลเรียบร้อย');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\data_cars_in  $data_cars_in
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      if($request->type == 1){ //ลบรายการรถยนต์
        $item = data_cars_in::find($id);
        $item2 = status_cars_in::where('id_car_in',$id);
        $item->Delete();
        $item2->Delete();
        return redirect()->Route('datacarin',1)->with('success','ลบข้อมูลเรียบร้อย');
      }

      
    }
    public function uploadImg(Request $request){

      if ($request->hasFile('file_image')) {

        $path = public_path().'/upload-image/'.$request->path;
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        $image_array = $request->file('file_image');
        $array_len = count($image_array);

        for ($i=0; $i < $array_len; $i++) {   

          $filename    = $image_array[$i]->getClientOriginalName();
           $image_resize = Image::make($image_array[$i]->getRealPath());              
        
          $image_resize->resize(900, 900, function ($constraint) {
          $constraint->aspectRatio();
          $constraint->upsize();
      });

          $image_new_name = $request->get('Nameid_Car_in').$dataImage.'.'.$image_array[$i]->getClientOriginalExtension();

          $dataImage++;
          $destination_path = public_path().'/upload-image/'.$request->get('Nameid_Car_in');
          
          $image_resize->save($destination_path.'/'.$image_new_name);

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
    public function ReportExcel(Request $request)
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
      if($report=='sale'){
      return view('dataCars.report' ,compact(['fdate','tdate','report','type']));
        }
        else{
           return view('dataCars.tradeInReport' ,compact(['fdate','tdate','report','type']));
        }
    }
   
    public function createTo(Request $request,$id)
    {
     $todayBE = \Carbon\Carbon::now()->format('Y')."-". \Carbon\Carbon::now()->format('m')."-". \Carbon\Carbon::now()->format('d');

     $datacar = data_cars_in::find($id);
     $statuscar = status_cars_in::where('id_car_in',$id)->first();
     $datacar2 = data_car::where('Number_Regist',$datacar->Nameid_Car_in)->count();

     if($datacar2==0){
      $datacardb = new data_car([
        'create_date' => $todayBE,
        'Fisrt_Price' => $statuscar->Price_head,
        'Brand_Car' => $datacar->Brand_Car_in,
        'Version_Car' => $datacar->Version_Car_in,
        'Model_Car' => $datacar->Model_Car_in,
        'Number_Miles' => $datacar->Miles_Car_in,
        'Color_Car' => $datacar->Color_car_in,
        'Gearcar' => $datacar->Gear_Car_in,
        'Year_Product' => $datacar->Car_Year_in,
        'Size_Car' => $datacar->Size_Car_in,
        'Number_Regist' => $datacar->Nameid_Car_in,
        'Name_Sale' => $datacar->Sale_Name,
        'Comsale_turn' => $statuscar->Comsale_in,
        'Origin_Car' => $datacar->Return_car,
        'Date_Carry' => $datacar->Date_Carry_in,
        'Type_buy'=>$datacar->Return_new_car,
        'Return_Price'=>$datacar->TotalFN,
        'Chassis_car'=>$datacar->id_body_car,
        'Car_type' => '1',
        
      ]);
      $datacardb->save();

      $datacar->Datacar_id = $datacardb->id;
      $datacar->Status_Car_in1 = 4;
      $datacar->update();

      $checkDoc = new checkDocument([
        'Datacar_id' => $datacardb->id,
        'Name_CarUser'=> $datacar->Name_Cus_in,
        
      ]);
      $checkDoc->save();

      $filecar = UploadfileImage::where('Datacarfileimage_id','=',$id)->update(['ID_Carware' => $datacardb->id,'Type_fileimage'=>2]);

      return redirect()->Route('datacar',1)->with('success','บันทึกข้อมูลเรียบร้อย');
    }
    else{
      return redirect()->Route('datacarin',1)->with('danger','มีข้อมูลใน Car WareHouse แล้ว');
    }
  }
  
}
