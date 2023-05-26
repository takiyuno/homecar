<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon;
use App\data_car;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($name)
    {
        

        date_default_timezone_set('Asia/Bangkok');
        $Y = date('Y');
        $m = date('m');
        $d = date('d');
        $date = $Y.'-'.$m.'-'.$d;
        $newdate = date('Y-m-d', strtotime('+3 days'));

        // ระบบรถบ้าน
        $data1 = data_car::count(); //รถในสต็อกทั้งหมด
        $data2 = data_car::where('Car_type', '=', 2 )->count(); //ระหว่างทำสี
        $data3 = data_car::where('Car_type', '=', 3 )->count(); //รอซ่อม
        $data4 = data_car::where('Car_type', '=', 4 )->count(); //ระหว่างซ่อม
        $data5 = data_car::where('Car_type', '=', 5 )->count(); //พร้อมขาย
        $data6 = data_car::where('Car_type', '=', 6 )->count(); //ขายแล้ว
        $data0 = data_car::where('Car_type', '=', 1 )->count(); //ขายแล้ว

       
          $today = \Carbon\Carbon::now()->format('Y') + 543 ."-". \Carbon\Carbon::now()->format('m')."-". \Carbon\Carbon::now()->format('d');
        
        
        $data7 = DB::table('data_cars')
                      ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                      ->whereNotNull('check_documents.Date_NumberUser')
                      ->where('data_cars.Car_type','<>',6)
                      ->select(DB::raw("SUM(DATEDIFF(DATE_FORMAT(check_documents.Date_NumberUser,'%Y-%m-%d'),CONCAT( DATE_FORMAT( NOW( ) , '%Y' ), '-', DATE_FORMAT( NOW( ) , '%m' ) , '-', DATE_FORMAT( NOW( ) , '%d' ) ))<60) as sumExpire"))->first();//(['sumExpire']);

        $data8 = DB::table('tracking_cuses')
                      ->join('data_customers','tracking_cuses.F_DataCus_id','=','data_customers.DataCus_id')
                      ->whereNull('data_customers.Status_Cus')
                      ->orwhere('data_customers.Status_Cus','<>','ส่งมอบ')->count();
        // $data1 = DB::connection('sqlsrv2')->table('data_cars')->count(); //รถในสต็อกทั้งหมด
        // $data2 = DB::connection('sqlsrv2')->table('data_cars')->where('Car_type', '=', 2 )->count(); //ระหว่างทำสี
        // $data3 = DB::connection('sqlsrv2')->table('data_cars')->where('Car_type', '=', 3 )->count(); //รอซ่อม
        // $data4 = DB::connection('sqlsrv2')->table('data_cars')->where('Car_type', '=', 4 )->count(); //ระหว่างซ่อม
        // $data5 = DB::connection('sqlsrv2')->table('data_cars')->where('Car_type', '=', 5 )->count(); //พร้อมขาย
        // $data6 = DB::connection('sqlsrv2')->table('data_cars')->where('Car_type', '=', 3 )->count(); //ขายแล้ว
        
        return view($name, compact('data1','data2','data3','data4','data5','data6','data7','data8','data0'));
    }
}
