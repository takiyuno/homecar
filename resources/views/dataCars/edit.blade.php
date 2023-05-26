@extends('layouts.master')
@section('title','แก้ไขข้อมูลรถยนต์')
@section('content')

<!-- <link type="text/css" rel="stylesheet" href="{{ asset('css/magiczoomplus.css') }}"/> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

<!-- <script type="text/javascript" src="{{ asset('js/magiczoomplus.js') }}"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>

@php
date_default_timezone_set('Asia/Bangkok');
$Y = date('Y');
$Y2 = date('Y');
$m = date('m')-3;
$d = date('d');
//$date = date('Y-m-d');
$time = date('H:i');
$date = $Y.'-'.$m.'-'.$d;
$date2 = $Y2.'-'.'01'.'-'.'01';
$date3 = $Y.'-'.'01'.'-'.'01';
@endphp

<style>
#todo-list{
  width:100%;
  /* margin:0 auto 190px auto; */
  padding:5px;
  background:white;
  position:relative;
  /*box-shadow*/
  -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
  -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
  box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
  /*border-radius*/
  -webkit-border-radius:5px;
  -moz-border-radius:5px;
  border-radius:5px;}
  #todo-list:before{
    content:"";
    position:absolute;
    z-index:-1;
    /*box-shadow*/
    -webkit-box-shadow:0 0 20px rgba(0,0,0,0.4);
    -moz-box-shadow:0 0 20px rgba(0,0,0,0.4);
    box-shadow:0 0 20px rgba(0,0,0,0.4);
    top:50%;
    bottom:0;
    left:10px;
    right:10px;
    /*border-radius*/
    -webkit-border-radius:100px / 10px;
    -moz-border-radius:100px / 10px;
    border-radius:100px / 10px;
  }
  .todo-wrap{
    display:block;
    position:relative;
    padding-left:35px;
    /*box-shadow*/
    -webkit-box-shadow:0 2px 0 -1px #ebebeb;
    -moz-box-shadow:0 2px 0 -1px #ebebeb;
    box-shadow:0 2px 0 -1px #ebebeb;
  }
  .todo-wrap:last-of-type{
    /*box-shadow*/
    -webkit-box-shadow:none;
    -moz-box-shadow:none;
    box-shadow:none;
  }
  input[type="radio"]{
    position:absolute;
    height:0;
    width:0;
    opacity:0;
    /* top:-600px; */
  }
  .todo{
    display:inline-block;
    font-weight:200;
    padding:10px 5px;
    height:37px;
    position:relative;
  }
  .todo:before{
    content:'';
    display:block;
    position:absolute;
    top:calc(50% + 10px);
    left:0;
    width:0%;
    height:1px;
    background:#cd4400;
    /*transition*/
    -webkit-transition:.25s ease-in-out;
    -moz-transition:.25s ease-in-out;
    -o-transition:.25s ease-in-out;
    transition:.25s ease-in-out;
  }
  .todo:after{
    content:'';
    display:block;
    position:absolute;
    z-index:0;
    height:18px;
    width:18px;
    top:9px;
    left:-25px;
    /*box-shadow*/
    -webkit-box-shadow:inset 0 0 0 2px #d8d8d8;
    -moz-box-shadow:inset 0 0 0 2px #d8d8d8;
    box-shadow:inset 0 0 0 2px #d8d8d8;
    /*transition*/
    -webkit-transition:.25s ease-in-out;
    -moz-transition:.25s ease-in-out;
    -o-transition:.25s ease-in-out;
    transition:.25s ease-in-out;
    /*border-radius*/
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    border-radius:4px;
  }
  .todo:hover:after{
    /*box-shadow*/
    -webkit-box-shadow:inset 0 0 0 2px #949494;
    -moz-box-shadow:inset 0 0 0 2px #949494;
    box-shadow:inset 0 0 0 2px #949494;
  }
  .todo .fa-check{
    position:absolute;
    z-index:1;
    left:-31px;
    top:0;
    font-size:1px;
    line-height:36px;
    width:36px;
    height:36px;
    text-align:center;
    color:transparent;
    text-shadow:1px 1px 0 white, -1px -1px 0 white;
  }
  :checked + .todo{
    color:#717171;
  }
  :checked + .todo:before{
    width:100%;
  }
  :checked + .todo:after{
    /*box-shadow*/
    -webkit-box-shadow:inset 0 0 0 2px #0eb0b7;
    -moz-box-shadow:inset 0 0 0 2px #0eb0b7;
    box-shadow:inset 0 0 0 2px #0eb0b7;
  }
  :checked + .todo .fa-check{
    font-size:20px;
    line-height:35px;
    color:#0eb0b7;
  }

</style>

<!-- Main content -->
<section class="content">
  <div class="content-header">
    <div class="card">
      <form name="form1" method="post" action="{{ route('MasterDataCarIn.update',$id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card-header">

          <div class="row">
            <div class="col-4">
              <div class="form-inline">
                <h4>แก้ไขข้อมูลรถยนต์</h4>
              </div>
            </div>
            @if($datacar->Status_Car_in1==4)
            <input type="hidden" name="Status_Car_in1" value="{{$datacar->Status_Car_in1}}">
            @endif
            <div class="col-8">
              <div class="card-tools d-inline float-right">
                <button type="submit" class="delete-modal btn btn-success">
                  <i class="fas fa-save"></i> อัพเดท
                </button>
                <a class="delete-modal btn btn-danger" href="{{ route('datacarin',1) }}">
                  <i class="far fa-window-close"></i> ยกเลิก
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body text-sm">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-car"></i> ข้อมูลรถยนต์</h3>
                  
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right"><font color="red">* วันที่ดูรถ </font> :</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control form-control-sm" name="Date_Car_in" value="{{ $datacar->Date_Car_in }}"  readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right"><font color="red">* เลขทะเบียน</font> :</label>
                        <div class="col-sm-8">
                          <input type="text" name="Nameid_Car_in" class="form-control form-control-sm" placeholder="ป้อนเลขทะเบียน" value="{{ $datacar->Nameid_Car_in}}" required/>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right"><font color="red">* ยี่ห้อรถ</font> :</label>
                        <div class="col-sm-8">
                          <select name="Brand_Car_in" class="form-control form-control-sm" required>
                            <option value="" selected>--- เลือกยี่ห้อรถ ---</option>
                            <option value="TOYOTA" {{ ($datacar->Brand_Car_in =="TOYOTA") ? 'selected' : '' }}>TOYOTA</option>
                            <option value="MAZDA" {{ ($datacar->Brand_Car_in =="MAZDA") ? 'selected' : '' }}>MAZDA</option>
                            <option value="NISSAN" {{ ($datacar->Brand_Car_in =="NISSAN") ? 'selected' : '' }}>NISSAN</option>
                            <option value="FORD" {{ ($datacar->Brand_Car_in =="FORD") ? 'selected' : '' }}>FORD</option>
                            <option value="MITSUBISHI" {{ ($datacar->Brand_Car_in =="MITSUBISHI") ? 'selected' : '' }}>MITSUBISHI</option>
                            <option value="ISUZU" {{ ($datacar->Brand_Car_in=="ISUZU") ? 'selected' : '' }}>ISUZU</option>
                            <option value="HONDA" {{ ($datacar->Brand_Car_in=="HONDA") ? 'selected' : '' }}>HONDA</option>
                            <option value="CHEVROLET" {{ ($datacar->Brand_Car_in=="CHEVROLET") ? 'selected' : '' }}>CHEVROLET</option>
                            <option value="SUZUKI" {{ ($datacar->Brand_Car_in=="SUZUKI") ? 'selected' : '' }}>SUZUKI</option>
                            <option value="MG" {{ ($datacar->Brand_Car_in=="MG") ? 'selected' : '' }}>MG</option>
                            <option value="อื่นๆ" {{ ($datacar->Brand_Car_in=="อื่นๆ") ? 'selected' : '' }}>อื่นๆ</option>

                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">

                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">แหล่งที่มาของรถ : </label>
                        <div class="col-sm-8">
                          <select name="CarType_in" class="form-control form-control-sm">
                           <option value="" selected>--- แหล่งที่มา ---</option>
                           <option value="1" {{ ($datacar->CarType_in === '1') ? 'selected' : '' }}>ป้ายโฆษณา/รถแห่/วิทยุ/จดหมาย</option>
                           <option value="2" {{ ($datacar->CarType_in === '2') ? 'selected' : '' }}>ลูกค้าไฟแนนซ์เก่า/ลูกค้าซื้อขายเก่า</option>
                           <option value="3" {{ ($datacar->CarType_in === '3') ? 'selected' : '' }}>นายหน้า/ลูกค้าแนะนำ</option>
                           <option value="4" {{ ($datacar->CarType_in === '4') ? 'selected' : '' }}>ศูนย์บริการ</option>
                           <option value="5" {{ ($datacar->CarType_in === '5') ? 'selected' : '' }}>FB บริษัท</option>
                           <option value="6" {{ ($datacar->CarType_in === '6') ? 'selected' : '' }}>FB ส่วนตัว</option>
                           <option value="7" {{ ($datacar->CarType_in === '7') ? 'selected' : '' }}>Line บริษัท</option>
                           <option value="8" {{ ($datacar->CarType_in === '8') ? 'selected' : '' }}>Walk In</option>
                           <option value="9" {{ ($datacar->CarType_in === '9') ? 'selected' : '' }}>Call In</option>
                           <option value="10" {{ ($datacar->CarType_in === '10') ? 'selected' : '' }}>อื่นๆ</option>
                         </select>
                         
                       </div>
                     </div>
                   </div>
                 </div>
                 <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">ลักษณะรถ :</label>
                      <div class="col-sm-8">
                        <select name="Model_Car_in" class="form-control form-control-sm">

                          <option value="" selected>--- เลือกลักษณะรถ ---</option>
                          <option value="กระบะตอนเดียว" {{ ($datacar->Model_Car_in=="กระบะตอนเดียว") ? 'selected' : '' }}>กระบะตอนเดียว</option>
                          <option value="กระบะตอนเดียวโฟรวิล" {{ ($datacar->Model_Car_in=="กระบะตอนเดียวโฟรวิล") ? 'selected' : '' }}>กระบะตอนเดียวโฟรวิล</option>
                          <option value="กระบะตอนครึ่ง" {{ ($datacar->Model_Car_in=="กระบะตอนครึ่ง") ? 'selected' : '' }}>กระบะตอนครึ่ง</option>
                          <option value="กระบะตอนครึ่งยกสูง" {{ ($datacar->Model_Car_in=="กระบะตอนครึ่งยกสูง") ? 'selected' : '' }}>กระบะตอนครึ่งยกสูง</option>
                          <option value="กระบะสี่ประตู" {{ ($datacar->Model_Car_in=="กระบะสี่ประตู") ? 'selected' : '' }}>กระบะสี่ประตู</option>
                          <option value="กระบะสี่ประตูยกสูง" {{ ($datacar->Model_Car_in=="กระบะสี่ประตูยกสูง") ? 'selected' : '' }}>กระบะสี่ประตูยกสูง</option>
                          <option value="เก๋ง" {{ ($datacar->Model_Car_in=="เก๋ง") ? 'selected' : '' }}>เก๋ง</option>
                          <option value="MPV" {{ ($datacar->Model_Car_in=="MPV") ? 'selected' : '' }}>MPV</option>
                          <option value="Van" {{ ($datacar->Model_Car_in=="Van") ? 'selected' : '' }}>รถตู้</option>
                          <option value="SUV" {{ ($datacar->Model_Car_in=="SUV") ? 'selected' : '' }}>SUV</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">เลขไมล์ :</label>
                      <div class="col-sm-8">
                        <input type="text" id="Miles_Car_in" name="Miles_Car_in" class="form-control form-control-sm" placeholder="ป้อนเลขไมล์" oninput="mile();" maxlength="10" value="{{ $datacar->Miles_Car_in}}" />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">รุ่นรถ :</label>
                      <div class="col-sm-8">
                        <input type="text" name="Version_Car_in" value="{{ $datacar->Version_Car_in}}" class="form-control form-control-sm" placeholder="ป้อนรุ่นรถ" />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">เกียร์รถ / ปีรถ :</label>
                      <div class="col-sm-4">
                        <select name="Gear_Car_in" class="form-control form-control-sm">
                          <option value="">-----เลือกเกียร์รถ------</option>
                          <option value="MT" {{ ($datacar->Gear_Car_in =="MT") ? 'selected' : '' }}>MT</option>
                          <option value="AT" {{ ($datacar->Gear_Car_in =="AT") ? 'selected' : '' }}>AT</option>
                        </select>
                      </div>
                      <div class="col-sm-4">
                        <input type="text" name="Car_Year_in" value="{{ $datacar->Car_Year_in}}"  class="form-control form-control-sm"  placeholder="ป้อนปีที่ผลิต"/>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">ขนาด :</label>
                      <div class="col-sm-8">
                        <input type="text" name="Size_Car_in" value="{{ $datacar->Size_Car_in}}" class="form-control form-control-sm" placeholder="ป้อนขนาด C.C." />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">สีรถ :</label>
                      <div class="col-sm-8">
                        <input type="text" name="Color_car_in" value="{{ $datacar->Color_car_in}}"  class="form-control form-control-sm" placeholder="ป้อนสีรถ" />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <script>
                    function addCommas(nStr){
                      nStr += '';
                      x = nStr.split('.');
                      x1 = x[0];
                      x2 = x.length > 1 ? '.' + x[1] : '';
                      var rgx = /(\d+)(\d{3})/;
                      while (rgx.test(x1)) {
                        x1 = x1.replace(rgx, '$1' + ',' + '$2');
                      }
                      return x1 + x2;
                    }

                    function mile(){
                      var num11 = document.getElementById('MilesCar').value;
                      var num1 = num11.replace(",","");
                      document.form1.MilesCar.value = addCommas(num1);

                            // var num22 = document.getElementById('AccountingCost').value;
                            // var num2 = num22.replace(",","");
                            // document.form1.AccountingCost.value = addCommas(num2);

                            var num44 = document.getElementById('ReturnPrice').value;
                            var num4 = num44.replace(",","");
                            document.form1.ReturnPrice.value = addCommas(num4);

                            var num33 = document.getElementById('PriceCar').value;
                            var num3 = num33.replace(",","");
                            document.form1.PriceCar.value = addCommas(num3);
                          }
                        </script>

                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right"> ราคาลูกค้า :</label>
                            <div class="col-sm-8">
                              <input type="text" id="Cus_Need_price" name="Cus_Need_price" class="form-control form-control-sm" value="{{ $datacar->Cus_Need_price}}"  placeholder="ป้อนราคาลูกค้าต้องการ" oninput="mile();" maxlength="10"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">Sale :</label>
                            <div class="col-sm-8">
                              @if(auth::user()->position=='SALE')
                              <input type="text" name="Sale_Name" value="{{ $datacar->Sale_Name}}" class="form-control form-control-sm" placeholder="ป้อน Sale" />
                              @else
                              <select name="Sale_Name" class="form-control form-control-sm" required>
                                @foreach ($user as $key => $value)
                                <option value="{{$value->username}}" {{ ($datacar->Sale_Name== $value->username) ? 'selected' : '' }}>{{$value->username}}</option>
                                @endforeach

                              </select>
                              @endif
                            </div>
                          </div>
                        </div>

                      </div>
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ลักษณะรถ :</label>
                            <div class="col-sm-8">
                              <textarea name="Detail_Car_in" class="form-control form-control-sm" placeholder="ลักษณะรถ/สภาพ" >{{ $datacar->Detail_Car_in}}</textarea>
                              
                            </div>
                          </div>
                        </div>
                        @php
                        $chk_no = '';
                        $chk_yes = '';
                        $textFN = '';
                        if($datacar->StatusFN_Car_in != 'other'){
                          $display = 'style=display:none';
                        }else{
                          $display = 'style=display:block';
                          $textFN = $datacar->Other_FN;
                        }

                        @endphp
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">สถานะไฟแนนซ์ :</label>
                            <div class="col-sm-6">
                              <select id="StatusFN_Car_in" name="StatusFN_Car_in" class="form-control form-control-sm">
                                <option value="ไม่ติดไฟแนนซ์" {{ ($datacar->StatusFN_Car_in=="ไม่ติดไฟแนนซ์") ? 'selected' : '' }}>ไม่ติดไฟแนนซ์</option>
                                <option value="กรุงศรี" {{ ($datacar->StatusFN_Car_in=="กรุงศรี") ? 'selected' : '' }}>กรุงศรี</option>
                                <option value="ธนชาติ" {{ ($datacar->StatusFN_Car_in=="ธนชาติ") ? 'selected' : '' }}>ธนชาติ</option>
                                <option value="ทิสโก้" {{ ($datacar->StatusFN_Car_in=="ทิสโก้") ? 'selected' : '' }}>ทิสโก้</option>
                                <option value="ไทยพาณิชย์" {{ ($datacar->StatusFN_Car_in=="ไทยพาณิชย์") ? 'selected' : '' }}>ไทยพาณิชย์</option>
                                <option value="กสิกรลิสซิ่ง" {{ ($datacar->StatusFN_Car_in=="กสิกรลิสซิ่ง") ? 'selected' : '' }}>กสิกรลิสซิ่ง</option>
                                <option value="โตโยต้าลิสซิ่ง" {{ ($datacar->StatusFN_Car_in=="โตโยต้าลิสซิ่ง") ? 'selected' : '' }}>โตโยต้าลิสซิ่ง</option>
                                <option value="ฮอนด้าลิสซิ่ง" {{ ($datacar->StatusFN_Car_in=="ฮอนด้าลิสซิ่ง") ? 'selected' : '' }}>ฮอนด้าลิสซิ่ง</option>                                
                                <option value="other" {{ ($datacar->StatusFN_Car_in=="other") ? 'selected' : '' }}>อื่นๆ</option>
                              </select>
                              <div {{ $display }} id="showFinane">
                                <input type="text" name="name_finance" id="name_finance" class="form-control form-control-sm" value="{{ $textFN }}" placeholder="ระบุชื่อไฟแนนซ์" />
                              </div>                                   
                            </div>
                          </div>
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">วันที่ปิดไฟแนนซ์ / ยอด :</label>
                            <div class="col-sm-4">
                             <input type="date" class="form-control form-control-sm" name="DateFN" value="{{ $datacar->DateFN }}"  >
                           </div>
                           <div class="col-sm-4">
                            <input type="text" name="TotalFN" value="{{ $datacar->TotalFN}}"  class="form-control form-control-sm"  placeholder="จำนวนยอดที่ปิด"/>
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group row mb-1">
                          <label class="col-sm-3 col-form-label text-right">ประเภทการซื้อ :</label>
                          <div class="col-sm-8">
                            <select name="Return_car" id="Return_car" class="form-control form-control-sm">
                              <option value="" selected>--- เลือกลักษณะรถ ---</option>
                              <option value="5" {{ ($datacar->Return_car=="5") ? 'selected' : '' }}>เทิร์นรถใหม่</option>
                              <option value="6" {{ ($datacar->Return_car=="6") ? 'selected' : '' }}>เทิร์นรถมือสอง</option>
                              <option value="8" {{ ($datacar->Return_car=="8") ? 'selected' : '' }}>Hi นายหน้า</option>
                              <option value="2" {{ ($datacar->Return_car=="2") ? 'selected' : '' }}>Hi รถประมูล</option>
                              <option value="7" {{ ($datacar->Return_car=="7") ? 'selected' : '' }}>รถซื้อหน้าเต้น</option>
                              <option value="9" {{ ($datacar->Return_car=="9") ? 'selected' : '' }}>เทิร์นรถ GWM</option>
                            </select>
                          </div>
                        </div>

                      </div>
                      @php
                      $return_dis = '';

                      if($datacar->Return_car == '5'||$datacar->Return_car == "6"){
                        $return_dis = 'style=display:block';
                      }else{
                        $return_dis = 'style=display:none';
                      }
                      @endphp
                      <div class="col-6" id="re_show" {{$return_dis}}>
                        <div class="form-group row mb-1">
                          <label class="col-sm-3 col-form-label text-right">ประเภทการซื้อเข้า :</label>
                          <div class="col-sm-8">
                           <select name="Return_new_car" id="Return_new_car" class="form-control form-control-sm">
                            <option value="" selected>--- เลือกประเภท ---</option>
                            <option value="บริษัท" {{ ($datacar->Return_new_car=="บริษัท") ? 'selected' : '' }}>บริษัท</option>
                            <option value="SV" {{ ($datacar->Return_new_car=="SV") ? 'selected' : '' }}>SV</option>

                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                     <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">เลขตัวถัง :</label>
                      <div class="col-sm-8">
                        <input type="text" name="id_body_car" id="id_body_car" value="{{ $datacar->id_body_car }}" class="form-control form-control-sm" placeholder="เลขตัวถัง" >
                      </div>
                    </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card card-warning">
                        <div class="card-header">
                          <h3 class="card-title"><i class="fas fa-car"></i> รูปรถยนต์</h3>
                          <a href="#" class="btn btn-default btn-sm float-left" title="เพิ่มรูปรถ" data-toggle="modal" data-target="#modal-default">
                            <i class="far fa-image" id="addpic">เพิ่มรูป</i> 
                          </a>
                          <div class="card-tools">

                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                            </button>
                          </div>                        
                        </div>
                        <div class="card-body">
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group row mb-1">
                                @foreach($dataImage as $key => $images)

                                <div class="col-sm-3 col-form-label text-center">
                                  <figure class="figure">                
                                    <a href="{{ asset('upload-image/'.$datacar->id.'/'.$images->Name_fileimage) }}" data-title="ภาพผู้เช่าซื้อ"></a>
                                    <img src="{{ asset('upload-image/'.$datacar->id.'/'.$images->Name_fileimage) }}" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure." >
                                    <figcaption class="figure-caption "> 

                                      <a href="{{ route('datacarin.deletePic',$images->fileimage_id) }}?type={{2}}&path={{$datacar->Nameid_Car_in}}">
                                        <button type="button" name="form2" id="delete_pic" data-name="{{ $images->fileimage_id }}" class=" btn btn-danger btn-sm " title="ลบรายการ">

                                          <i class="far fa-trash-alt"></i>
                                        </button></a>



                                      </figcaption>                                      
                                    </figure>
                                  </div>
                                  @endforeach
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @if(auth::user()->position != "SALE" )
                  <hr>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title"><i class="fas fa-user-check"></i> ข้อมูลตีเทิร์น</h3>
                        </div>


                        <div class="card-body">
                          <div class="row">
                            <div class="col-6"> 
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">สถานะรถ :</label>
                                <div class="col-md-8">                                   
                                  <div class="todo-wrap">
                                    <span class="col-sm-5">
                                      <input type="radio" id="3" name="Look_Car_in" value="yes" {{ ($datacar->Look_Car_in=="yes") ? 'checked' : '' }}/>
                                      <label for="3" class="todo">
                                        <i class="fa fa-check"></i>
                                        เห็นรถจริง 
                                      </label>
                                    </span> &nbsp; &nbsp; &nbsp; 
                                    <span class="col-sm-5">
                                      <input type="radio" id="4" name="Look_Car_in" value="no" {{ ($datacar->Look_Car_in=="no") ? 'checked' : '' }}/>
                                      <label for="4" class="todo">
                                        <i class="fa fa-check"></i>
                                        ดูรูปภาพ
                                      </label>
                                    </span>
                                  </div>                    
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ราคาตีเทิร์น :</label>
                                <div class="col-sm-8">
                                  <input type="text" name="Price_head" value="{{ $datacar->Price_head}}" class="form-control form-control-sm" placeholder="ราคาตีเทิร์น" />
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">งบจากรถใหม่ :</label>
                                <div class="col-sm-8">
                                  <input type="text" name="Price_Budget" value="{{ $datacar->Price_Budget}}" class="form-control form-control-sm" placeholder="งบจากรถใหม่" />
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ค่าคอมฝ่ายขาย :</label>
                                <div class="col-sm-8">
                                  <input type="text" name="Comsale_in" value="{{ $datacar->Comsale_in}}" class="form-control form-control-sm" placeholder="ค่าคอมฝ่ายขาย" />
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-6">
                             <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right">สถานะรถ :</label>
                              <div class="col-md-8">
                                <span class="todo-wrap">
                                  <span class="col-sm-5">
                                    <input type="radio" id="5" name="Status_Car_in" value="yes" {{ ($datacar->Status_Car_in=="yes") ? 'checked' : '' }}/>
                                    <label for="5" class="todo">
                                      <i class="fa fa-check"></i>
                                      จอง
                                    </label> 
                                  </span> &nbsp; &nbsp; &nbsp; 
                                  <span class="col-sm-5">
                                    <input type="radio" id="6" name="Status_Car_in" value="no" {{ ($datacar->Status_Car_in=="no") ? 'checked' : '' }}/>
                                    <label for="6" class="todo">
                                      <i class="fa fa-check"></i>
                                      ไม่จอง
                                    </label>
                                  </span>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right">สาเหตุการจอง/ไม่จอง :</label>
                              <div class="col-sm-8">
                                <textarea name="Status_Detail" class="form-control form-control-sm" placeholder="" >{{ $datacar->Status_Detail }}</textarea>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                         <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">หมายเหตุ ผจก :</label>
                            <div class="col-sm-8">
                              <textarea name="Remark" class="form-control form-control-sm" placeholder="หมายเหตุ ผจก" >{{ $datacar->Remark}}</textarea>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">วันที่นัดดูรถ  :</label>
                            <div class="col-sm-8">
                              <input type="date" class="form-control form-control-sm" name="Date_See_Car" value="{{ $datacar->Date_See_Car }}"  >
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">

                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">วันที่รับรถ  :</label>
                            <div class="col-sm-8">
                              <input type="date" class="form-control form-control-sm" name="Date_Carry" value="{{ $datacar->Date_Carry_in }}"  >
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif
            </div>


          </div>
        </div>
      </div> 
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-user"></i> ข้อมูลลูกค้า</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-1">
                  <label class="col-sm-3 col-form-label text-right">ชื่อหน้าเล่ม :</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control form-control-sm" name="Name_Cus_Car" value="{{$datacar->Name_Cus_Car}}"  placeholder="ป้อนชื่อหน้าเล่ม">
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row mb-1">
                  <label class="col-sm-3 col-form-label text-right">ชื่อลูกค้าที่ติดต่อ :</label>
                  <div class="col-sm-8">
                    <input type="text" name="Name_Cus_in" class="form-control form-control-sm" value="{{$datacar->Name_Cus_in}}" placeholder="ป้อนชื่อลูกค้า" />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-1">
                  <label class="col-sm-3 col-form-label text-right">ชื่อเล่น :</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control form-control-sm" name="Nick_Cus_in" value="{{$datacar->Nick_Cus_in}}"  placeholder="ป้อนชื่อเล่น">
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row mb-1">
                  <label class="col-sm-3 col-form-label text-right">เบอร์ติดต่อ :</label>
                  <div class="col-sm-8">
                    <input type="text" name="Tel_Cus_in" value="{{$datacar->Tel_Cus_in}}"  class="form-control form-control-sm" placeholder="ป้อนเบอร์ติดต่อลูกค้า" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal-default" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div class="form-group">
              <div class="file-loading">
                <input id="image-file" type="file" name="file_image[]" accept="image/*" data-min-file-count="1" multiple>
              </div>
            </div>
                        <!-- <div class="row">
                          <div class="col-12">
                          @foreach($dataImage as $key => $images)
                              <div class="col-sm-6">
                                <a href="{{ asset('upload-image/'.$images->Name_fileimage) }}" data-title="ภาพผู้เช่าซื้อ">
                                  <img src="{{ asset('upload-image/'.$images->Name_fileimage) }}" width="450px">
                                </a>
                              </div>
                          @endforeach
                        </div>
                      </div> -->
                      <hr>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-success">อัพโหลด</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                    </div>
                    <br>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <input type="hidden" name="_method" value="PATCH"/>
            </form>
            <a id="button"></a>
          </div>
        </div>
      </section>


      {{-- button-to-top --}}
      <script>
        $('#Return_car').on('change',function(){

          if($('#Return_car').val() == '5'|| $('#Return_car').val()== "6")
          {
           $('#re_show').show();         
         }
         else
         {
           $('#re_show').hide();
       //$('#Return_new_car').val('');
     }
   });


        $('#StatusFN_Car_in').on('change',function(){

          if( $('#StatusFN_Car_in').val()=="other")
          {
           $('#showFinane').show();         
         }
         else
         {
           $('#showFinane').hide();
           $('#name_finance').val('');
         }
       });
        var btn = $('#button');

        $(window).scroll(function() {
          if ($(window).scrollTop() > 300) {
            btn.addClass('show');
          } else {
            btn.removeClass('show');
          }
        });

        btn.on('click', function(e) {
          e.preventDefault();
          $('html, body').animate({scrollTop:0}, '300');
        });
      </script>

      <!-- DateNumberUserHidden -->
      <script>
        function myFunctionDateUser() {
          var x = document.getElementById("DateNumberUser").value;
          document.form1.mySelect1.value = x;
        }
      </script>

      <!-- DateExpireHidden -->
      <script>
        function myFunctionDateExpire() {
          var x = document.getElementById("DateExpire").value;
          document.form1.mySelect2.value = x;
        }
      </script>

      {{-- image --}}
      <script type="text/javascript">

        $('#addpic').on('click',function(){
          confirm('กรุณาตรวจสอบความถูกต้องของทะเบียนรถ');
        });

        $("#image-file").fileinput({
          showUpload: false,
      //uploadUrl:"{{ route('datacarin.uploadImg') }}?path={{$datacar->Nameid_Car_in}}&id={{$datacar->id}}",
      uploadUrl:"{{url('/upload-image/'.$datacar->Nameid_Car_in)}}",
      theme:'fa',
      uploadExtraData:function(){
        return{
          _token:"{{csrf_token()}}",
        }
      },
      allowedFileExtensions:['jpeg','jpg','png','gif'],
      maxFileSize:10240,
      fileActionSettings: {
        showRemove: true,
    showUpload: false, //This remove the upload button
    showZoom: true,
    showDrag: false
  },
})
</script>

@endsection
