@extends('layouts.master')
@section('title','ร้อมูลรถยนต์มือ 2')
@section('content')

@php
date_default_timezone_set('Asia/Bangkok');
$Y = date('Y');
$Y2 = date('Y');
$m = date('m');
$d = date('d');
//$date = date('Y-m-d');
$time = date('H:i');
$date = $Y.'-'.$m.'-'.$d;
$date2 = $Y2.'-'.'01'.'-'.'01';
@endphp

<style>
#todo-list{
  width:100%;
  margin:0 auto 30px auto;
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
  input[type="checkbox"]{
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
      <form name="form1" action="{{ route('datacar.store') }}" method="post" id="formimage" enctype="multipart/form-data">
        @csrf

        <div class="card-header">
          {{-- <h5 class="" style="text-align:center;"><b>เพิ่มข้อมูลรถยนต์</b></h5> --}}
          <div class="row">
            <div class="col-4">
              <div class="form-inline">
                <h5>เพิ่มข้อมูลรถยนต์</h5>
              </div>
            </div>
            <div class="col-8">
              <div class="card-tools d-inline float-right">
                <button type="submit" class="delete-modal btn btn-success btn-sm">
                  <i class="fas fa-save"></i> บันทึก
                </button>
                <a class="delete-modal btn btn-danger btn-sm" href="{{ route('datacar',1) }}">
                  <i class="far fa-window-close"></i> ยกเลิก
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body text-sm"> 
          <div class="row">
            <div class="col-md-9">
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-car"></i> ข้อมูลรถยนต์</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right"><font color="red">* วันที่ซื้อ</font> :</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control form-control-sm" name="DateCar" value="{{ $date }}"  required>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right"><font color="red">* ยี่ห้อรถ</font> :</label>
                        <div class="col-sm-8">
                          <select name="BrandCar" class="form-control form-control-sm" required>
                            <option value="" selected>--- เลือกยี่ห้อรถ ---</option>
                            <option value="TOYOTA">TOYOTA</option>
                            <option value="MAZDA">MAZDA</option>
                            <option value="NISSAN">NISSAN</option>
                            <option value="FORD">FORD</option>
                            <option value="MITSUBISHI">MITSUBISHI</option>
                            <option value="ISUZU">ISUZU</option>
                            <option value="HONDA">HONDA</option>
                            <option value="CHEVROLET">CHEVROLET</option>
                            <option value="SUZUKI">SUZUKI</option>
                            <option value="MG">MG</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right"><font color="red">* เลขทะเบียน</font> :</label>
                        <div class="col-sm-8">
                          <input type="text" name="Number_Regist" class="form-control form-control-sm" placeholder="ป้อนเลขทะเบียน" required/>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right"><font color="red">* ที่มาของรถ</font> :</label>
                        <div class="col-sm-8">
                          <select name="OriginCar" class="form-control form-control-sm" required>
                            <option value="" selected>--- เลือกที่มาของรถ ---</option>
                            <option value="1">CKL</option>
                            <option value="2">รถประมูล</option>
                            <option value="3">รถยึด</option>
                            <option value="4">ฝากขาย</option>
                            <option value="5">เทิร์นรถใหม่</option>
                            <option value="6">เทิร์นรถมือสอง</option>
                            <option value="7">ซื้อหน้าเต็นท์</option>
                            <option value="9">เทิร์นรถ GWM</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">Sale :</label>
                        <div class="col-sm-8">
                          <input type="text" name="SaleCar" class="form-control form-control-sm" placeholder="ป้อน Sale" />
                         <!--  <select name="SaleCar" class="form-control form-control-sm" >
                            @foreach ($user as $key => $value)
                            <option value="{{$value->username}}">{{$value->username}}</option>
                            @endforeach
                          </select> -->
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">ลักษณะรถ :</label>
                        <div class="col-sm-8">
                          <select name="ModelCar" class="form-control form-control-sm">
                            <option value="" selected>--- เลือกลักษณะรถ ---</option>
                            <option value="กระบะตอนเดียว">กระบะตอนเดียว</option>
                            <option value="กระบะตอนเดียวโฟรวิล">กระบะตอนเดียวโฟรวิล</option>
                            <option value="กระบะตอนครึ่ง">กระบะตอนครึ่ง</option>
                            <option value="กระบะตอนครึ่งยกสูง">กระบะตอนครึ่งยกสูง</option>
                            <option value="กระบะสี่ประตู">กระบะสี่ประตู</option>
                            <option value="กระบะสี่ประตูยกสูง">กระบะสี่ประตูยกสูง</option>
                            <option value="เก๋ง">เก๋ง</option>
                            <option value="MPV">MPV</option>
                            <option value="Van">รถตู้</option>
                            <option value="SUV">SUV</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">เลขไมล์ :</label>
                        <div class="col-sm-8">
                          <input type="text" id="MilesCar" name="MilesCar" class="form-control form-control-sm" placeholder="ป้อนเลขไมล์" oninput="mile();" maxlength="10"/>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">รุ่นรถ :</label>
                        <div class="col-sm-8">
                          <input type="text" name="VersionCar" class="form-control form-control-sm" placeholder="ป้อนรุ่นรถ" />
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">เกียร์รถ / ปีรถ :</label>
                        <div class="col-sm-4">
                          <select name="Gearcar" class="form-control form-control-sm">
                            <option value="">-----เลือกเกียร์รถ------</option>
                            <option value="MT">MT</option>
                            <option value="AT">AT</option>
                          </select>
                        </div>
                        <div class="col-sm-4">
                          <input type="text" name="YearCar" class="form-control form-control-sm"  placeholder="ป้อนปีที่ผลิต"/>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">ขนาด :</label>
                        <div class="col-sm-8">
                          <input type="text" name="SizeCar" class="form-control form-control-sm" placeholder="ป้อนขนาด C.C." />
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">สีรถ :</label>
                        <div class="col-sm-8">
                          <input type="text" name="ColorCar" class="form-control form-control-sm" placeholder="ป้อนสีรถ" />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">Job Number :</label>
                        <div class="col-sm-8">
                          <input type="text" name="JobCar" class="form-control form-control-sm" placeholder="ป้อน JobNumber" />
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">เลขตัวถัง :</label>
                        <div class="col-sm-8">
                          <input type="text" id="ChassisCar" name="ChassisCar" class="form-control form-control-sm" placeholder="เลขตัวถัง" />
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
                        @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" || auth::user()->position =="Staff")
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right"><font color="red">* ราคาซื้อ</font> :</label>
                            <div class="col-sm-8">
                              <input type="text" id="PriceCar" name="PriceCar" class="form-control form-control-sm" placeholder="ป้อนราคาซื้อ" oninput="mile();" maxlength="10"/>
                            </div>
                          </div>
                        </div>
                        @endif

                        <!-- <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ต้นทุนยอดจัด :</label>
                            <div class="col-sm-8">
                              <input type="text" id="AccountingCost" name="AccountingCost" class="form-control form-control-sm" placeholder="ต้นทุนยอดจัด" oninput="mile();" maxlength="10"/>
                            </div>
                          </div>
                        </div> -->
                      </div>
                      <div class="col-6">
                        <div class="form-group row mb-1">
                          <label class="col-sm-3 col-form-label text-right">จ่ายไฟแนนซ์ :</label>
                          <div class="col-sm-8">
                            <input type="text" id="ReturnPrice" name="ReturnPrice" class="form-control form-control-sm" placeholder="ราคาจ่ายไฟแนนซ์" oninput="mile();" maxlength="10"/>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="card card-danger">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-tasks"></i> เช็คเอกสารรถยนต์</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="" id="todo-list">
                            <div class="row">
                              <div class="col-md-2">
                                <span class="todo-wrap">
                                  <input type="checkbox" id="1" name="ContractsCar" value="complete"/>
                                  <label for="1" class="todo">
                                    <i class="fa fa-check"></i>
                                    สัญญาซื้อขาย
                                  </label>
                                </span>
                              </div>
                              <div class="col-md-2">
                                <span class="todo-wrap">
                                  <input type="checkbox" id="2" name="ManualCar" value="complete"/>
                                  <label for="2" class="todo">
                                    <i class="fa fa-check"></i>
                                    คู่มือ
                                  </label>
                                </span>
                              </div>
                              <div class="col-md-2">
                                <span class="todo-wrap">
                                  <input type="checkbox" id="3" name="Certi_doc" value="complete"/>
                                  <label for="3" class="todo">
                                    <i class="fa fa-check"></i>
                                    ใบมอบอำนาจ
                                  </label>
                                </span>
                              </div>
                              <div class="col-md-2">
                                <span class="todo-wrap">
                                  <input type="checkbox" id="4" name="Trans_doc" value="complete"/>
                                  <label for="4" class="todo">
                                    <i class="fa fa-check"></i>
                                    ใบโอนขนส่ง
                                  </label>
                                </span>
                              </div>
                              <div class="col-md-2">
                                <span class="todo-wrap">
                                  <input type="checkbox" id="5" name="Id_doc" value="complete"/>
                                  <label for="5" class="todo">
                                    <i class="fa fa-check"></i>
                                    บัตรประชาชน
                                  </label>
                                </span>
                              </div>
                              <div class="col-md-2">
                                <span class="todo-wrap">
                                  <input type="checkbox" id="6" name="Regist_car" value="complete"/>
                                  <label for="6" class="todo">
                                    <i class="fa fa-check"></i>
                                    เล่มทะเบียน
                                  </label>
                                </span>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-2">
                                <span class="todo-wrap">
                                  <input type="checkbox" id="7" name="Regist_house" value="complete"/>
                                  <label for="7" class="todo">
                                    <i class="fa fa-check"></i>
                                    สำเนาทะเบียนบ้าน
                                  </label>
                                </span>
                              </div>
                              <div class="col-md-2">
                                <span class="todo-wrap">
                                  <input type="checkbox" id="3" name="KeyReserve" value="complete"/>
                                  <label for="3" class="todo">
                                    <i class="fa fa-check"></i>
                                    กุญแจ
                                  </label>
                                </span>
                              </div>
                              <div class="col-md-2">
                                <span class="todo-wrap">
                                  <input type="checkbox" id="4" name="ExpireTax" value="complete"/>
                                  <label for="4" class="todo">
                                    <i class="fa fa-check"></i>
                                    ป้ายภาษี
                                  </label>
                                </span>
                              </div>

                              <div class="col-3">
                                <div class="form-group row mb-1">
                                  <label class="col-sm-3 col-form-label text-right"><font color="red">พ.ร.บ.</font> :</label>
                                  <div class="col-sm-6">
                                    <input type="date" class="form-control form-control-sm" name="Act_Car" value="" required>
                                  </div>
                                </div>
                              </div>
                              <div class="col-3">
                                <div class="form-group row mb-1">
                                  <label class="col-sm-3 col-form-label text-right"><font color="red">ประกัน</font> :</label>
                                  <div class="col-sm-6">
                                    <input type="date" class="form-control form-control-sm" name="Insurance_Car" value=""  required>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-1">
                  <label class="col-sm-3 col-form-label text-right">ชื่อเจ้าของรถ :</label>
                  <div class="col-sm-8">
                    <input type="text" id="NameCarUser" class="form-control form-control-sm" name="NameCarUser"  placeholder="ชื่อเจ้าของรถ">
                  </div>
                </div>
                <div class="form-group row mb-1">
                  <label class="col-sm-3 col-form-label text-right">วันที่หมดอายุ ปชช :</label>
                  <div class="col-sm-8">
                    <input type="date" id="DateNumberUser" class="form-control form-control-sm" name="DateNumberUser"  placeholder="ป้อนวันที่หมดอายุ ปชช">
                  </div>
                </div>
                <div class="form-group row mb-1">
                  <label class="col-sm-3 col-form-label text-right">วันที่หมดอายุภาษี:</label>
                  <div class="col-sm-8">
                    <input type="date" id="DateExpire" class="form-control form-control-sm" name="DateExpire"  placeholder="ป้อนวันที่หมดอายุภาษี">
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row mb-1">
                  <label class="col-sm-3 col-form-label text-right">หมายเหตุ :</label>
                  <div class="col-sm-8">
                    <textarea name="CheckNote" class="form-control form-control-sm" placeholder="ป้อนหมายเหตุ" rows="4"></textarea>
                  </div>
                </div>
              </div>
            </div>

            <input type="hidden" id="mySelect1" class="form-control form-control-sm" name="DateNumberUserHidden" >
            <input type="hidden" id="mySelect2" class="form-control form-control-sm" name="DateExpireHidden" >
            <input type="hidden" name="Cartype" value="{{ $type }}" class="form-control"/>         
            <input type="hidden" name="type" value="1" class="form-control"/>         
          </div>

          <input type="hidden" name="_token" value="{{csrf_token()}}" />
        </form>
      </div>
    </div>
  </section>

  <!-- DateNumberUserHidden -->
  <script>
    function myFunctionDateUser() {
      var x = document.getElementById("DateNumberUser").value;
      document.form1.mySelect1.value = x;
    }
  </script>

  <!-- DateExpireHidden       -->
  <script>
    function myFunctionDateExpire() {
      var x = document.getElementById("DateExpire").value;
      document.form1.mySelect2.value = x;
    }
  </script>

  <script type="text/javascript">
    $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
      $(".alert").alert('close');
    });
  </script>
  @endsection
