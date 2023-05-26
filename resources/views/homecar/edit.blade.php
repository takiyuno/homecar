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
$Y = date('Y') ;
$Y2 = date('Y') ;
$m = date('m');
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
      <form name="form1" method="post" action="{{ route('MasterDatacar.update',$id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card-header">

          <div class="row">
            <div class="col-4">
              <div class="form-inline">
                <h4>แก้ไขข้อมูลรถยนต์</h4>
              </div>
            </div>
            <div class="col-8">
              <div class="card-tools d-inline float-right">
                <a class="delete-modal btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-2" data-backdrop="static" data-link="{{ route('datacar.trackingCars',[$id,$datacar->Car_type,15]) }}">
                  <i class="fas fa-plus"></i> Tracking
                </a>
                @if(auth()->user()->position == 'Admin')
                <button type="submit" class="update-modal btn btn-success">
                  <i class="fas fa-save"></i> อัพเดท
                </button>
                @endif
                <a class="delete-modal btn btn-danger" href="{{ URL::previous() }}">
                  <i class="far fa-window-close"></i> ยกเลิก
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body text-sm">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-car"></i> ข้อมูลรถยนต์</h3>

                  <div class="card-tools">
                    @if($datacar->BookStatus_Car == 'จอง')
                    <button type="button" class="btn btn-primary btn-tool" data-toggle="modal" data-target="#modal-1">
                      <i class="fas fa-user"></i> รถยนต์ติดจอง
                    </button>
                    @endif
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                      <i class="fas fa-expand"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right"><font color="red">* วันที่ซื้อ</font> :</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control form-control-sm" name="DateCar" value="{{$datacar->create_date}}">
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right"><font color="red">สถานะ</font> :</label>
                        <div class="col-sm-8">
                          <select name="Cartype" id="Cartype"  class="form-control form-control-sm">
                            @foreach ($arrayCarType as $key => $value)
                            <option value="{{$key}}" {{ ($key == $datacar->Car_type) ? 'selected' : '' }}>{{$value}}</option>
                            @endforeach
                          </select>
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
                            @foreach ($arrayBrand as $key => $value)
                            <option value="{{$key}}" {{ ($key == $datacar->Brand_Car) ? 'selected' : '' }}>{{$value}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right"><font color="red">* เลขทะเบียน</font> :</label>
                        <div class="col-sm-8">
                          <input type="text" name="Number_Regist" class="form-control form-control-sm" value="{{$datacar->Number_Regist}}" required/>
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
                            @foreach ($arrayOriginType as $key => $value)
                            <option value="{{$key}}" {{ ($key == $datacar->Origin_Car) ? 'selected' : '' }}>{{$value}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">Sale :</label>
                        <div class="col-sm-8">
                          <input type="text" name="SaleCar" class="form-control form-control-sm" value="{{$datacar->Name_Sale}}"/>
                         <!--  <select name="SaleCar" class="form-control form-control-sm" >
                            @foreach ($user as $key => $value)
                            <option value="{{$value->username}}" {{ ($datacar->Name_Sale== $value->username) ? 'selected' : '' }}>{{$value->username}}</option>
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
                          <select name="ModelCar" id="ModelCar" class="form-control form-control-sm">
                            @foreach ($arrayModel as $key => $value)
                            <option value="{{$key}}" {{ ($key == $datacar->Model_Car) ? 'selected' : '' }}>{{$value}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">เลขไมล์ :</label>
                        <div class="col-sm-8">
                          <input type="text" id="MilesCar" name="MilesCar" class="form-control form-control-sm" value="{{$datacar->Number_Miles}}" oninput="mile();" maxlength="10"/>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">รุ่นรถ :</label>
                        <div class="col-sm-8">
                          <input type="text" name="VersionCar" class="form-control form-control-sm" value="{{$datacar->Version_Car}}" />
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">เกียร์รถ / ปีรถ :</label>
                        <div class="col-sm-4">
                          <select name="Gearcar" class="form-control form-control-sm">
                            @foreach ($arrayGearcar as $key => $value)
                            <option value="{{$key}}" {{ ($key == $datacar->Gearcar) ? 'selected' : '' }}>{{$value}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-sm-4">
                          <input type="text" name="YearCar" class="form-control form-control-sm" value="{{$datacar->Year_Product}}"/>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">ขนาด :</label>
                        <div class="col-sm-8">
                          <input type="text" name="SizeCar" class="form-control form-control-sm" value="{{$datacar->Size_Car}}"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">สีรถ :</label>
                        <div class="col-sm-8">
                          <input type="text" name="ColorCar" class="form-control form-control-sm" value="{{$datacar->Color_Car}}" />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">Job Number :</label>
                        <div class="col-sm-8">
                          <input type="text" name="JobCar" class="form-control form-control-sm" value="{{$datacar->Job_Number}}" />
                        </div>
                      </div>
                      
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">เลขตัวถัง :</label>
                        <div class="col-sm-8">
                          <input type="text" name="ChassisCar" class="form-control form-control-sm" value="{{$datacar->Chassis_car}}" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">Link Show Car :</label>
                        <div class="col-sm-8">
                          <input type="text" name="car_link" class="form-control form-control-sm" value="{{$datacar->car_link}}" placeholder="เว็บไซต์" />
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">เคลมMMTH:</label>
                        <div class="col-sm-8">
                         <select class="form-control form-control-sm" name="claim_MMTH">
                          <option value="">--เลือก--</option>
                          <option value="เคลมได้ เอกสารเรียบร้อย" {{ ($datacar->claim_MMTH=="เคลมได้ เอกสารเรียบร้อย") ? 'selected' : '' }}>เคลมได้ เอกสารเรียบร้อย</option>
                          <option value="เคลมได้ รอเอกสารเพิ่มเติม"{{ ($datacar->claim_MMTH=="เคลมได้ รอเอกสารเพิ่มเติม") ? 'selected' : '' }}>เคลมได้ รอเอกสารเพิ่มเติม</option>
                          <option value="เคลมไม่ได้"{{ ($datacar->claim_MMTH=="เคลมไม่ได้") ? 'selected' : '' }}>เคลมไม่ได้</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">ประเภทการซื้อเข้า:</label>
                      <div class="col-sm-8">
                       <select class="form-control form-control-sm" name="Type_buy">
                        <option value="">--เลือก--</option>
                        <option value="บริษัท" {{ ($datacar->Type_buy =="บริษัท") ? 'selected' : '' }}>บริษัท</option>
                        <option value="SV" {{ ($datacar->Type_buy=="SV") ? 'selected' : '' }}>SV</option>
                        
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-warning">
                      <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-car"></i> รูปรถยนต์ </h3> 
                        <a href="#" class="btn  btn-sm float-left" title="เพิ่มรูปรถ" data-toggle="modal" data-target="#modal-default" >
                          <i class="far fa-images" style="font-size: 18px;"></i>
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
                              @php 
                              //if($images->Datacarfileimage_id!=null && $images->Type_fileimage==2 && $images->ID_Carware !=NULL){ 
                                
                              // }else{
                                //$path_id = $images->ID_Carware;
                              //} 
                              $path_id =$images->Datacarfileimage_id;
                              if( $path_id != NULL){
                              @endphp

                              <div class="col-sm-3 col-form-label text-center">
                                <figure class="figure">                
                                  <a href="{{ asset('upload-image/'.$path_id.'/'.$images->Name_fileimage) }}" data-title="ภาพผู้เช่าซื้อ"></a>
                                  <img src="{{ asset('upload-image/'.$path_id.'/'.$images->Name_fileimage) }}" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure." >
                                  <figcaption class="figure-caption "> 
                                        <!-- <form method="post" id="pic"  action="{{ route('MasterDatacar.destroy',$images->fileimage_id) }}" style="display:inline;">

                                          <input type="hidden" name="_method" value="DELETE" />
                                          <input type="hidden" name="type" value="3" />
                                          <input type="hidden" name="path" value="{{$datacar->Number_Regist}}" />
                                          <input type="hidden" name="fileimage_id" value="{{$images->fileimage_id}}" /> -->
                                        @if(auth()->user()->position == 'Admin')
                                          <a href="{{ route('datacar.deletePic',[$images->fileimage_id]) }}?type=3&path={{$datacar->id}}" class="confirmdelete">
                                            <button type="button" name="form2" id="delete_pic"  class=" btn btn-danger btn-sm " title="ลบรายการ">

                                              <i class="far fa-trash-alt"></i>
                                            </button></a>
                                            @endif
                                            <!-- </form> -->
                                          </figcaption>                                      
                                        </figure>
                                      </div>
                                      @php
                                    }
                                      @endphp
                                      @endforeach
                                    </div>
                                   <!--  <div class="form-group row mb-0">
                                      <label class="col-sm-3 col-form-label text-right"> วันที่ดูรถ :</label>
                                      <div class="col-sm-8">
                                       
                                      </div>
                                    </div> -->
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <hr>



                      <script>


                        function sum() {
                          var num11,num33,num44,num55,num10,num41,num51,TranFee1 = 0;
                          var num1 = $('#PriceCar').val();
                          num11 = num1.replace(",","");
                          // var num2 = $('#OfferPrice').val();
                          // var num22 = num2.replace(",","");
                          var num3 = $('#RepairCar').val();
                          var num33 = num3.replace(",","");
                          var num4 = $('#ColorPrice').val();
                          num44 = num4.replace(",","");
                          var num5 = $('#AddPrice').val();
                          num55 = num5.replace(",","");
                          var num6 = $('#NetCar').val();
                          var num66 = num6.replace(",","");
                          
                             // var num7 = document.getElementById('AccountingCost').value;
                             // var num77 = num7.replace(",","");
                             var num88 = $('#Open_auction').val();
                             var num8 = num88.replace(",","");
                             var num99 = $('#Close_auction').val();
                             var num9 = num99.replace(",","");
                             num10 = $('#Budget_Gift').val();
                             num10 = num10.replace(",","");
                             var num211= $('#ExpectedRepair').val();
                             var num21 = num211.replace(",","");
                             var num311 = $('#ExpectedColor').val();
                             var num31 = num311.replace(",","");
                             var num411 = $('#InsurPrice').val();
                             num41 = num411.replace(",","");
                             num51 = $('#CostInsur').val();
                             var TranFee = $('#TranFee').val();
                             TranFee1 = TranFee.replace(",","");

                             var com_turn = $('#Comsale_turn').val();
                             var com_turn2 = com_turn.replace(",","");

                             var com_sale = $('#com_sale').val();
                             var com_sale2 = com_sale.replace(",","");

                             var result=0;
                             result = parseFloat(num11)+parseFloat(num33)+parseFloat(num44)+parseFloat(num55)+parseFloat(num10)+parseFloat(num41)+parseFloat(num51)+parseFloat(TranFee1)+parseFloat(com_turn2)+parseFloat(com_sale2);

                             // document.form1.PriceCar.value = addCommas(num11);
                             // document.form1.OfferPrice.value = addCommas(num22);
                             // document.form1.RepairCar.value = addCommas(num33);
                             // document.form1.ColorPrice.value = addCommas(num44);
                             // document.form1.AddPrice.value = addCommas(num55);
                             // document.form1.NetCar.value = addCommas(num66);
                             //  //document.form1.AccountingCost.value = addCommas(num77);
                             //  document.form1.Open_auction.value = addCommas(num8);
                             //  document.form1.Close_auction.value = addCommas(num9);
                             //  document.form1.Budget_Gift.value = addCommas(num10);
                             //  document.form1.ExpectedRepair.value = addCommas(num21);
                             //  document.form1.ExpectedColor.value = addCommas(num31);
                             //  document.form1.TranFee.value = addCommas(TranFee1);
                             //  // document.form1.LigerPrice.value = addCommas(num41);


                              // var NetCar = result+parseFloat(num2);

                              // if(!isNaN(NetCar)){
                              //   var final_net = parseFloat(NetCar);
                              //   final2 = addCommas(final_net.toFixed(2));
                              //   document.form1.NetCar.value = final2;
                              // }

                              if(!isNaN(result)){
                                var final_result = parseFloat(result);
                                final = addCommas(final_result.toFixed(2));
                                document.form1.CapitalPrice.value = final;
                              }
                            }

                          </script>

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

                              return x1+x2;
                            }

                            function mile(){
                              var num11 = document.getElementById('MilesCar').value;
                              var num1 = num11.replace(",","");
                              document.form1.MilesCar.value = addCommas(num1);

                            // var num22 = document.getElementById('AccountingCost').value;
                            // var num2 = num22.replace(",","");
                            // document.form1.AccountingCost.value = addCommas(num2);

                            // var num44 = document.getElementById('OfferPrice').value;
                            // var num4 = num44.replace(",","");
                            // document.form1.OfferPrice.value = addCommas(num4);

                            var num33 = document.getElementById('PriceCar').value;
                            var num3 = num33.replace(",","");
                            document.form1.PriceCar.value = addCommas(num3);
                          }
                        </script>

                        <script>
                          $('#Cartype').change(function(){
                            var value = document.getElementById('Cartype').value;
                            if(value == '7'){
                              $('#show1').show();
                              $('#show2').show();
                            }else{
                              $('#show1').hide();
                              $('#show2').hide();
                            }
                            if(value=='6'){
                             $("#disSold").css("display", "block");
                           }else{
                             $("#disSold").css("display", "none");
                           }
                         });

                          
                       </script>
<div class="panel panel-default">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-danger">
                      <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-dollar-sign"></i> ข้อมูลราคา </h3> 
                        
                        <div class="card-tools">

                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                          </button>
                        </div>                        
                      </div>
                      <div class="card-body">

                       @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT")
                       <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right"><font color="red">ราคาซื้อ</font> :</label>
                            <div class="col-sm-8">
                              <input type="text" id="PriceCar" name="PriceCar" class="form-control form-control-sm" value="{{number_format(intval($datacar->Fisrt_Price),2)}}" onkeyup="sum();" maxlength="10" required/>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">Vat Car :</label>
                            <div class="col-sm-8">
                              <select name="Vat_car_buy" class="form-control form-control-sm">
                                <option value="" >---เลือกประเภท---</option>
                                <option value="ก่อนVat" {{ ($datacar->Vat_car_buy=='ก่อนVat') ? 'selected' : '' }}>ก่อนVat</option>
                                 <option value="รวมVat" {{ ($datacar->Vat_car_buy=='รวมVat') ? 'selected' : '' }}>รวมVat</option>
                                 <option value="ไม่มีVat" {{ ($datacar->Vat_car_buy=='ไม่มีVat') ? 'selected' : '' }}>ไม่มีVat</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ราคาซ่อม :</label>
                            <div class="col-sm-8">
                              <input type="text" id="RepairCar" name="RepairCar" class="form-control form-control-sm" value="{{number_format(intval($datacar->Repair_Price), 2)}}" onkeyup="sum();" maxlength="10"/>
                            </div>
                          </div>
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">หมายเหตุซ่อม :</label>
                            <div class="col-sm-8">
                              <textarea type="text" name="RepairRemark" class="form-control" rows="3" placeholder="หมายเหตุซ่อม">{{ $datacar->Repair_Remark }}</textarea>                                
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ราคาเพิ่มเติม :</label>
                            <div class="col-sm-8">
                              <input type="text" id="AddPrice" name="AddPrice" class="form-control form-control-sm" value="{{number_format(intval($datacar->Add_Price), 2)}}" onkeyup="sum();"  maxlength="10"/>
                            </div>
                          </div>
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">หมายเหตุเพิ่มเติม :</label>
                            <div class="col-sm-8">
                             <textarea type="text" name="AddRemark" class="form-control" rows="3" placeholder="หมายเหตุซ่อม">{{ $datacar->Add_Remark }}</textarea>    
                           </div>
                         </div>

                       </div>
                     </div>
                     
                     <div class="row">
                      <div class="col-6">
                        <div class="form-group row mb-1">
                          <label class="col-sm-3 col-form-label text-right">ราคาทำสี :</label>
                          <div class="col-sm-8">
                            <input type="text" id="ColorPrice" name="ColorPrice" class="form-control form-control-sm" value="{{number_format(intval($datacar->Color_Price), 2)}}" onkeyup="sum();"  maxlength="10"/>
                          </div>
                        </div>
                        <div class="form-group row mb-1">
                          <label class="col-sm-3 col-form-label text-right">หมายเหตุทำสี :</label>
                          <div class="col-sm-8">
                            <textarea type="text" name="ColorRemark" class="form-control" rows="3" placeholder="หมายเหตุซ่อม">{{ $datacar->Color_Remark }}</textarea>                        
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group row mb-1">
                          <label class="col-sm-3 col-form-label text-right">จ่ายไฟแนนซ์ :</label>
                          <div class="col-sm-8">
                            <input type="text" id="ReturnPrice" name="ReturnPrice" class="form-control form-control-sm" placeholder="ราคาจ่ายไฟแนนซ์" value="{{number_format(intval($datacar->Return_Price), 2)}}" oninput="mile();" maxlength="10"/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div id="form_expen">
                      @include('homecar.viewTagPart')
                    </div>
                    <hr>
                    @endif

                    <div class="row">
                      @if($datacar->Car_type == "7")
                      <div div class="col-6" id="show1">
                        @else
                        <div div class="col-6" id="show1" style="display:none;">
                          @endif
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right"><font color="red">ราคาเปิดประมูล</font> :</label>
                            <div class="col-sm-8">
                              <input type="text" id="Open_auction" name="Open_auction" class="form-control form-control-sm" value="{{number_format(intval($datacar->Open_auction),2)}}" oninput="sum();" />
                            </div>
                          </div>
                        </div>

                        @if($datacar->Car_type == "7")
                        <div div class="col-6" id="show2">
                          @else
                          <div div class="col-6" id="show2" style="display:none;">
                            @endif
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right"><font color="red">ราคาปิดประมูล</font> :</label>
                              <div class="col-sm-8">
                                <input type="text" id="Close_auction" name="Close_auction" class="form-control form-control-sm" value="{{number_format(intval($datacar->Close_auction),2)}}" onkeyup="sum();" required/>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                         <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ค่าของแถม :</label>
                            <div class="col-sm-8">
                              <input type="text" id="Budget_Gift" name="Budget_Gift" class="form-control form-control-sm" value="{{number_format(intval($datacar->Budget_Gift), 2)}}" onkeyup="sum();" />
                            </div>
                          </div>
                        </div>           
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">คอมเซลล์เทิร์น :</label>
                            <div class="col-sm-8">
                              <input type="text" id="Comsale_turn" name="Comsale_turn" class="form-control form-control-sm" value="{{number_format(intval($datacar->Comsale_turn), 2)}}" onkeyup="sum();" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ค่าประกันรถ :</label>
                            <div class="col-sm-8">
                              <input type="text" id="InsurPrice" name="InsurPrice" class="form-control form-control-sm" value="{{number_format(intval($datacar->Insur_Price), 2)}}" onkeyup="sum();"  maxlength="10"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ค่าโอน :</label>
                            <div class="col-sm-8">                               
                              <input type="text" id="TranFee" name="TranFee" class="form-control form-control-sm" placeholder="ค่าโอน" value="{{number_format(intval($datacar->Tran_Fee),2)}}" onkeyup="sum();" maxlength="10"/>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ทุนประกัน :</label>
                            <div class="col-sm-8">
                              <input type="text" id="CostInsur" name="CostInsur" class="form-control form-control-sm" value="{{number_format(intval($datacar->Cost_Insur), 2)}}" onkeyup="sum();"  maxlength="10"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ทุนคอมเซลล์ขาย :</label>
                            <div class="col-sm-8">
                              <input type="text" id="com_sale" name="com_sale" class="form-control form-control-sm" value="{{number_format(intval($datacar->com_sale), 2)}}" onkeyup="sum();" />
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ราคาต้นทุน :</label>
                            <div class="col-sm-8">
                              <input type="text" id="CapitalPrice" name="CapitalPrice" class="form-control form-control-sm" value="{{number_format(intval($datacar->Fisrt_Price+$datacar->Repair_Price+$datacar->Color_Price+$datacar->Add_Price+$datacar->Budget_Gift+$datacar->Comsale_turn+$datacar->Insur_Price+$datacar->Tran_Fee+$datacar->com_sale),2)}}" placeholder="ราคาต้นทุน"  readonly />
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right"><font color="red">ราคาตั้งขาย</font> :</label>
                            <div class="col-sm-8">
                              <input type="text" id="NetCar" name="NetCar" class="form-control form-control-sm" value="{{number_format(intval($datacar->Net_Price), 2)}}"  />
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
              </div>
              <div class="card card-danger col-md-12">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-wrench"></i> ข้อมูลช่างซ่อม</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="col-md-10">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row mb-1">
                          <label class="col-sm-7 col-form-label text-right">ราคาประเมิณซ่อม :</label>
                          <div class="col-sm-5">
                            <input type="text" name="ExpectedRepair" id="ExpectedRepair" class="form-control form-control-sm" value="{{number_format(intval($datacar->Expected_Repair),2)}}" oninput="sum()"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row mb-1">
                          <label class="col-sm-7 col-form-label text-right">ราคาประเมิณทำสี :</label>
                          <div class="col-sm-5">
                            <input type="text" name="ExpectedColor" id="ExpectedColor" class="form-control form-control-sm" value="{{number_format(intval($datacar->Expected_Color),2)}}" oninput="sum()"  />
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
                              <span class="todo-wrap">
                                <input type="checkbox" id="1" name="ContractsCar" value="complete" {{ ($datacar->Contracts_Car == "complete") ? 'checked' : '' }}/>
                                <label for="1" class="todo">
                                  <i class="fa fa-check" ></i>
                                  สัญญาซื้อขาย
                                </label>
                              </span>
                              <span class="todo-wrap">
                                <input type="checkbox" id="2" name="ManualCar" value="complete" {{ ($datacar->Manual_Car == "complete") ? 'checked' : '' }}/>
                                <label for="2" class="todo">
                                  <i class="fa fa-check"></i>
                                  คู่มือ
                                </label>
                              </span>
                              <span class="todo-wrap">
                                <input type="checkbox" id="3" name="Certi_doc" value="complete" {{ ($datacar->Certi_doc == "complete") ? 'checked' : '' }}/>
                                <label for="3" class="todo">
                                  <i class="fa fa-check" ></i>
                                  ใบมอบอำนาจ
                                </label>
                              </span>

                              <span class="todo-wrap">
                                <input type="checkbox" id="4" name="Trans_doc" value="complete" {{ ($datacar->Trans_doc == "complete") ? 'checked' : '' }}/>
                                <label for="4" class="todo">
                                  <i class="fa fa-check"></i>
                                  ใบโอนขนส่ง
                                </label>
                              </span>
                              <span class="todo-wrap">
                                <input type="checkbox" id="5" name="Id_doc" value="complete" {{ ($datacar->Id_doc == "complete") ? 'checked' : '' }}/>
                                <label for="5" class="todo">
                                  <i class="fa fa-check" ></i>
                                  บัตรประชาชน
                                </label>
                              </span>

                              <span class="todo-wrap">
                                <input type="checkbox" id="6" name="Regist_car" value="complete" {{ ($datacar->Regist_car == "complete") ? 'checked' : '' }}/>
                                <label for="6" class="todo">
                                  <i class="fa fa-check"></i>
                                  เล่มทะเบียน
                                </label>
                              </span> 

                              <span class="todo-wrap">
                                <input type="checkbox" id="7" name="Regist_house" value="complete" {{ ($datacar->Regist_house == "complete") ? 'checked' : '' }}/>
                                <label for="7" class="todo">
                                  <i class="fa fa-check" ></i>
                                  สำเนาทะเบียนบ้าน
                                </label>
                              </span>

                              <span class="todo-wrap">
                                <input type="checkbox" id="8" name="KeyReserve" value="complete" {{ ($datacar->Key_Reserve == "complete") ? 'checked' : '' }}/>
                                <label for="8" class="todo">
                                  <i class="fa fa-check"></i>
                                  กุญแจ
                                </label>
                              </span>

                              <span class="todo-wrap">
                                <input type="checkbox" id="9" name="ExpireTax" value="complete" {{ ($datacar->Expire_Tax == "complete") ? 'checked' : '' }}/>
                                <label for="9" class="todo">
                                  <i class="fa fa-check"></i>
                                  ป้ายภาษี
                                </label>
                              </span>
                              <span class="todo-wrap">
                                <input type="checkbox" id="ChkCondition" name="ChkCondition" value="complete" {{ ($datacar->ChkCondition == "complete") ? 'checked' : '' }}/>
                                <label for="ChkCondition" class="todo">
                                  <i class="fa fa-check"></i>
                                  ใบตรวจสภาพ
                                </label>
                              </span>
                              <span class="todo-wrap">
                                <input type="checkbox" id="ChkTran" name="ChkTran" value="complete" {{ ($datacar->ChkTran == "complete") ? 'checked' : '' }}/>
                                <label for="ChkTran" class="todo">
                                  <i class="fa fa-check"></i>
                                  เช็คใบขนส่ง
                                </label>
                              </span>
                            </div>
                            <div class="row">
                              <div class="col-4">
                                <span class="todo-wrap">
                                 <div class="form-group row mb-1">
                                  <label ><font color="red">PDI_220</font> :</label>
                                  <div class="col-sm-8">
                                    <input type="date" class="form-control form-control-sm" name="PDI_220" value="{{$datacar->PDI_220}}" >
                                  </div>                                
                                </div>
                              </span>
                            </div>
                            <div class="col-4">
                              <span class="todo-wrap">
                                <div class="form-group row mb-1">
                                  <label ><font color="red">PDS</font> :</label>
                                  <div class="col-sm-8">
                                    <input type="date" class="form-control form-control-sm" name="PDS" value="{{$datacar->PDS}}" >
                                  </div>                                
                                </div>
                              </span>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-4">
                              <span class="todo-wrap">
                               <div class="form-group row mb-1">
                                <label ><font color="red">Social</font> :</label>
                                <div class="col-sm-8">
                                  <input type="date" class="form-control form-control-sm" name="Social" value="{{$datacar->Social}}" >
                                </div>                                
                              </div>
                            </span>
                          </div>
                          <div class="col-4">
                            <span class="todo-wrap">

                              <div class="form-group row mb-1">
                                <label ><font color="red">วันหมด พ.ร.บ.</font> :</label>
                                <div class="col-sm-8">
                                  <input type="date" class="form-control form-control-sm" name="Act_Car" value="{{$datacar->Act_Car}}" >
                                </div>
                              </div>
                            </span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-4">
                            <span class="todo-wrap">
                              <div class="form-group row mb-1">
                                <label ><font color="red">วันหมด ประกัน</font> :</label>
                                <div class="col-sm-8">
                                  <input type="date" class="form-control form-control-sm" name="Insurance_Car" value="{{$datacar->Insurance_Car}}">
                                </div>
                              </div>
                            </span>
                          </div>
                          <div class="col-4">
                            <span class="todo-wrap">
                              <div class="form-group row mb-1">
                                <label ><font color="red">Admin</font> :</label>
                                <div class="col-sm-8">
                                  <input type="file" class="form-control" name="file_doc[]" multiple placeholder="เอกสาร">
                                </div>
                              </div>
                            </span>
                           
                          </div>
                          <div class="col-4">
                           <span class="todo-wrap">
                              <div class="form-group row mb-1">
                                <label ><font color="red">ทะเบียน</font> :</label>
                                <div class="col-sm-8">
                                  <input type="file" class="form-control" name="file_doc2[]" multiple placeholder="เอกสาร">
                                </div>
                              </div>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-warning">
                      <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-file"></i> ภาพเอกสาร </h3> 
                       
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
                             @php
                               $allfile = $datacar->Doc_file;
                               $doc1 = explode(",",$allfile);
                                if(count($doc1)>0){

                                  for($i = 0 ;$i < count($doc1);$i++){
                                    if($doc1[$i]!=''){
                             @endphp

                               <div class="col-sm-3 col-form-label text-center">
                                <figure class="figure">                
                                  <a href="{{ asset('upload-image/'.$id.'/doc/'.$doc1[$i]) }}" data-title="ภาพผู้เช่าซื้อ">File {{$doc1[$i]}}</a>
                                  
                                  <figcaption class="figure-caption "> 
                                        {{-- <form method="post" id="pic"  action="{{ route('MasterDatacar.destroy',$images->fileimage_id) }}" style="display:inline;">

                                          <input type="hidden" name="_method" value="DELETE" />
                                          <input type="hidden" name="type" value="4" />
                                          <input type="hidden" name="path" value="{{$datacar->Number_Regist}}" />
                                          <input type="hidden" name="fileimage_id" value="{{$images->fileimage_id}}" /> --}}
                                          @if(auth()->user()->position == 'Admin')
                                          <a href="{{ route('datacar.deletePic',[$id]) }}?type=4&path={{$id}}&f_name={{$doc1[$i]}}&status=1" class="confirmdelete">
                                            <button type="button" name="form2" id="delete_pic"  class=" btn btn-danger btn-sm " title="ลบรายการ">

                                              <i class="far fa-trash-alt"></i>
                                            </button></a>
                                            @endif
                                            <!-- </form> -->
                                          </figcaption>                                      
                                        </figure>
                                      </div>
                                      @php
                                            }
                                          }
                                        }

                               $allfile2 = $datacar->Doc_file2;
                               $doc2 = explode(",",$allfile2);
                                if(count($doc2)>0){

                                  for($i = 0 ;$i < count($doc2);$i++){
                                    if($doc2[$i]!=''){
                             @endphp

                              <div class="col-sm-3 col-form-label text-center">
                                <figure class="figure">                
                                  <a href="{{ asset('upload-image/'.$id.'/doc/'.$doc2[$i]) }}" data-title="เอกสาร"></a>
                                  <img src="{{ asset('upload-image/'.$id.'/doc/'.$doc2[$i]) }}" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure." >
                                  <figcaption class="figure-caption "> 
                                        {{-- <form method="post" id="pic"  action="{{ route('MasterDatacar.destroy',$images->fileimage_id) }}" style="display:inline;">

                                          <input type="hidden" name="_method" value="DELETE" />
                                         --}}
                                         @if(auth()->user()->position == 'Admin')
                                          <a href="{{ route('datacar.deletePic',$id) }}?type=4&path={{$id}}&f_name={{$doc1[$i]}}&status=2" class="confirmdelete" target="_blank">
                                            <button type="button" name="form2" id="delete_pic"  class=" btn btn-danger btn-sm " title="ลบรายการ">

                                              <i class="far fa-trash-alt"></i>
                                            </button></a>
                                            @endif
                                            <!-- </form> -->
                                          </figcaption>                                      
                                        </figure>
                                      </div>
                                      @php
                                            }
                                          }
                                        }
                                      @endphp
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
          <!--   </div> -->

             <!-- <div class="row">
                 <div class="col-md-6">
                  <div class="card card-warning">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-book-reader"></i> ข้อมูลการยืมรถ</h3>
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
                            <label class="col-sm-3 col-form-label text-right">วันที่ยืม :</label>
                            <div class="col-sm-8">
                              <input type="date" id="DateBorrowcar" name="DateBorrowcar" class="form-control form-control-sm" value="{{$datacar->Date_Borrowcar}}" />
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ชื่อผู้ยืม :</label>
                            <div class="col-sm-8">
                              <input type="text" name="NameBorrow" class="form-control form-control-sm" value="{{$datacar->Name_Borrow}}"/>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">วันที่คืน :</label>
                            <div class="col-sm-8">
                              <input type="date" id="DateReturncar" name="DateReturncar" class="form-control form-control-sm" value="{{$datacar->Date_Returncar}}"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">สถานะ :</label>
                            <div class="col-sm-8">
                              <select name="BorrowStatus" class="form-control form-control-sm">
                                @foreach ($arrayBorrowStatus as $key => $value)
                                  <option value="{{$key}}" {{ ($key == $datacar->BorrowStatus) ? 'selected' : '' }}>{{$value}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">หมายเหตุ :</label>
                            <div class="col-sm-8">
                              <textarea type="text" name="NoteBorrow" class="form-control" rows="3" placeholder="ป้อนหมายเหตุ">{{ $datacar->Note_Borrow }}</textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-warning card-tabs">
                      <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="Sub-custom-tab1" data-toggle="pill" href="#Sub-tab1" role="tab" aria-controls="Sub-tab1" aria-selected="false"><i class="fas fa-address-card"></i>ข้อมูลบัตร</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="Sub-custom-tab2" data-toggle="pill" href="#Sub-tab2" role="tab" aria-controls="Sub-tab2" aria-selected="false"><i class="fas fa-hand-holding-usd"></i>การจัดไฟแนนท์</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link " id="Sub-custom-tab3" data-toggle="pill" href="#Sub-tab3" role="tab" aria-controls="Sub-tab3" aria-selected="false">บันทึกการติดตาม</a>
                          </li>
                        </ul>
                      </div> 
                      <div class="tab-content">
                        <div class="tab-pane fade show active" id="Sub-tab1" role="tabpanel" aria-labelledby="Sub-custom-tab1"> 

                      <!--<div class="card card-warning">
                         <div class="card-header">
                          <h3 class="card-title"><i class="fas fa-address-card"></i> ข้อมูลบัตร</h3>
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                            </button>
                          </div>
                        </div> 
                        <div class="card-body">-->

                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ชื่อเจ้าของรถ :</label>
                                <div class="col-sm-8">
                                  <input type="text" id="NameCarUser" class="form-control form-control-sm" name="NameCarUser"  value="{{ ($datacar->Name_CarUser != '') ?$datacar->Name_CarUser:'' }}" onchange="myFunctionDateUser()">
                                </div>
                              </div>
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">วันที่หมดอายุ ปชช :</label>
                                <div class="col-sm-8">
                                  <input type="date" id="DateNumberUser" class="form-control form-control-sm" name="DateNumberUser" value="{{ ($datacar->Date_NumberUser != '') ?$datacar->Date_NumberUser: 'วว/ดด/ปปปป' }}" onchange="myFunctionDateUser()">
                                </div>
                              </div>
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">วันที่หมดอายุภาษี :</label>
                                <div class="col-sm-8">
                                  <input type="date" id="DateExpire" class="form-control form-control-sm" name="DateExpire"  value="{{ ($datacar->Date_Expire != '') ?$datacar->Date_Expire: 'วว/ดด/ปปปป' }}" onchange="myFunctionDateExpire()">
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">หมายเหตุ :</label>
                                <div class="col-sm-8">
                                  <textarea type="text" name="CheckNote" class="form-control form-control-sm" rows="4" placeholder="ป้อนหมายเหตุ">{{ $datacar->Check_Note }}</textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                     <!-- </div>
                     </div> -->


                     <div class="tab-pane fade show" id="Sub-tab2" role="tabpanel" aria-labelledby="Sub-custom-tab2">
                      <div class="table-responsive text-sm">
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-4 col-form-label text-right">ราคาจัดธนชาติ :</label>
                              <div class="col-sm-6">
                                <input type="text" name="Price_Thana" class="form-control form-control-sm" value="{{number_format(intval($datacar->Price_Thana),2)}}" />
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-4 col-form-label text-right">ราคาจัด AY :</label>
                              <div class="col-sm-6">
                                <input type="text" name="Price_AY" class="form-control form-control-sm" value="{{number_format(intval($datacar->Price_AY),2)}}" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-4 col-form-label text-right">ราคาจัดทิสโก้ :</label>
                              <div class="col-sm-6">
                                <input type="text" name="Price_Tisco" class="form-control form-control-sm" value="{{number_format(intval($datacar->Price_Tisco),2)}}" />
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-4 col-form-label text-right">ราคาจัดชูเกียรติ :</label>
                              <div class="col-sm-6">
                                <input type="text" name="Price_Choo" class="form-control form-control-sm" value="{{number_format(intval($datacar->Price_Choo),2)}}" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-4 col-form-label text-right">ราคาจัดSCB :</label>
                              <div class="col-sm-6">
                                <input type="text" name="Price_Scb" class="form-control form-control-sm" value="{{number_format(intval($datacar->Price_Scb),2)}}" />
                              </div>
                            </div>
                          </div>
                            <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-4 col-form-label text-right">ราคาจัดเกียรตินาคิน :</label>
                              <div class="col-sm-6">
                                <input type="text" name="Price_Kiatnakin" class="form-control form-control-sm" value="{{number_format(intval($datacar->Price_Kiatnakin),2)}}" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-4 col-form-label text-right">ราคาจัดKL :</label>
                              <div class="col-sm-6">
                                <input type="text" name="Price_KLeasing" class="form-control form-control-sm" value="{{number_format(intval($datacar->Price_KLeasing),2)}}" />
                              </div>
                            </div>
                          </div>
                        </div>
                           <!-- <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-4 col-form-label text-right">ราคาจัดSCB ไม่มีประวัติ  :</label>
                              <div class="col-sm-6">
                                <input type="text" name="Price_NonScb" class="form-control form-control-sm" value="{{number_format(intval($datacar->Price_NonScb),2)}}" />
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-4 col-form-label text-right">ราคาจัด AY มีประวัติ :</label>
                              <div class="col-sm-6">
                                <input type="text" name="Price_AY" class="form-control form-control-sm" value="{{number_format(intval($datacar->Price_AY),2)}}" />
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-4 col-form-label text-right">ราคาจัด AY ไม่มีประวัติ  :</label>
                              <div class="col-sm-6">
                                <input type="text" name="Price_NonAY" class="form-control form-control-sm" value="{{number_format(intval($datacar->Price_NonAY),2)}}" />
                              </div>
                            </div>
                          </div>
                        </div> -->
                        
                      </div>
                    </div>
                    <div class="tab-pane fade show" id="Sub-tab3" role="tabpanel" aria-labelledby="Sub-custom-tab3">
                      <div class="table-responsive text-sm">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <th class="text-left">ครั้งที่</th>
                              <th class="text-left">วันที่ติดตาม</th>
                              <th class="text-left" >สถานะ</th>
                              <th class="text-left">บันทึกการติดตามสถานะรถ</th>
                              <th class="text-left">กำหนดเสร็จ</th>
                              <!--   <th class="text-left">หมายเหตุ (ผู้จัดการ)</th> -->
                              <!-- <th class="text-left">Sale Name</th> -->
                              <th class="text-left"></th>

                            </tr>
                          </thead>
                          <tbody>
                            @php
                            $no=1;
                            @endphp
                            @foreach($track_in as $key2 => $row2)
                            @php
                            $arrayCarType = [
                            
                            2 => 'รถยนต์ระหว่างทำสี',
                            3 => 'รถยนต์รอซ่อม',
                            4 => 'รถยนต์ระหว่างซ่อม',
                            
                            ];
                            @endphp
                            <tr>
                              <td class="col-1">{{ $no }}</td>
                              <td class="col-2">{{ $row2->track_date }}</td>
                              <td class="col-3">{{ $arrayCarType[$row2->status_car] }}</td>
                              <td class="text-left col-4">{{ $row2->detail_car }}</td>
                              <td class="text-left col-2">{{ $row2->end_date }}</td>
                              <td class="text-left">

                               <a class="btn btn-warning btn-sm" title="แก้ไขรายการ" data-toggle="modal" data-target="#modal-3" data-backdrop="static" data-link="{{ route('datacar.trackingCars',[ $row2->id,0,16]) }}">
                                <i class="far fa-edit"></i>
                              </a>

                            </td>

                          </tr>
                          @php
                          $no++;
                          @endphp
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <input type="hidden" id="mySelect1" class="form-control" name="DateNumberUserHidden" >
        <input type="hidden" id="mySelect2" class="form-control" name="DateExpireHidden" >
        <input type="hidden" id="id_forpic" class="form-control" name="{{$id}}" >
        <div class="modal fade" id="modal-default" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                <div class="form-group">

                  <div class="file-loading">
                    <input id="image-file" type="file" name="file_image[]" accept="image/*"  data-min-file-count="1" multiple>
                  </div>
                </div>

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
      </div>

      <input type="hidden" name="_method" value="PATCH"/>
    </form>
    <a id="button"></a>
  </div>
</div>
</section>

<!-- Pop up เพิ่มข้อมูล -->
<div class="modal fade" id="modal-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-body">
        <div class="card card-warning">
          <div class="card-header">
            <h4 class="card-title">
              <i class="fas fa-user"></i>&nbsp;
              ข้อมูลลูกค้า
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="card-body text-sm">
            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right">ชื่อ - นามสกุล : </label>
                  <div class="col-sm-8">
                    <input type="text" name="NameCus" class="form-control form-control-sm" value="{{ $datacar->Name_Cus }}"/>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right">เบอร์ติดต่อ : </label>
                  <div class="col-sm-8">
                    <input type="text" name="PhoneCus" class="form-control form-control-sm" value="{{ $datacar->Phone_Cus }}" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right">เลขบัตร ปชช. : </label>
                  <div class="col-sm-8">
                    <input type="text" name="IDCardCus" class="form-control form-control-sm" value="{{ $datacar->IDCard_Cus }}" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" />
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right">ที่อยู่ : </label>
                  <div class="col-sm-8">
                    <input type="text" name="AddressCus" class="form-control form-control-sm" value="{{ $datacar->Address_Cus }}"/>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right">จังหวัด/ไปรษณีย์ : </label>
                  <div class="col-sm-4">
                    <input type="text" name="ProvinceCus" class="form-control form-control-sm" value="{{ $datacar->Province_Cus }}"/>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" name="ZipCus" class="form-control form-control-sm"value="{{ $datacar->Zip_Cus }}" data-inputmask="&quot;mask&quot;:&quot;99999&quot;" data-mask=""/>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right">Email : </label>
                  <div class="col-sm-8">
                    <input type="text" name="EmailCus" class="form-control form-control-sm" value="{{ $datacar->Email_Cus }}"/>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right">อาชีพ : </label>
                  <div class="col-sm-8">
                    <input type="text" name="CareerCus" class="form-control form-control-sm" value="{{ $datacar->Career_Cus }}" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right">แหล่งที่มาลูกค้า : </label>
                  <div class="col-sm-8">
                    <select name="OriginCus" class="form-control form-control-sm">
                      <option value="" selected>--- แหล่งที่มา ---</option>
                      <option value="1" {{ ($datacar->Origin_Cus === '1') ? 'selected' : '' }}>ป้ายโฆษณา/รถแห่/วิทยุ/จดหมาย</option>
                      <option value="2" {{ ($datacar->Origin_Cus === '2') ? 'selected' : '' }}>ลูกค้าไฟแนนซ์เก่า/ลูกค้าซื้อขายเก่า</option>
                      <option value="3" {{ ($datacar->Origin_Cus === '3') ? 'selected' : '' }}>นายหน้า/ลูกค้าแนะนำ</option>
                      <option value="4" {{ ($datacar->Origin_Cus === '4') ? 'selected' : '' }}>ศูนย์บริการ</option>
                      <option value="5" {{ ($datacar->Origin_Cus === '5') ? 'selected' : '' }}>FB บริษัท</option>
                      <option value="6" {{ ($datacar->Origin_Cus === '6') ? 'selected' : '' }}>FB ส่วนตัว</option>
                      <option value="7" {{ ($datacar->Origin_Cus === '7') ? 'selected' : '' }}>Line บริษัท</option>
                      <option value="8" {{ ($datacar->Origin_Cus === '8') ? 'selected' : '' }}>Walk In</option>
                      <option value="9" {{ ($datacar->Origin_Cus === '9') ? 'selected' : '' }}>Call In</option>
                      <option value="10" {{ ($datacar->Origin_Cus === '10') ? 'selected' : '' }}>อื่นๆ</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right"><font color="red">ผู้เสนอราคา : </font></label>
                  <div class="col-sm-8">
                    <input type="text" name="SaleCus" value="{{ $datacar->Sale_Cus }}" class="form-control form-control-sm" readonly/>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right"><font color="red">วันที่รับลูกค้า : </font></label>
                  <div class="col-sm-8">
                    <input type="date" name="DateSaleCus" class="form-control form-control-sm" value="{{ $datacar->DateSale_Cus }}" readonly/>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right">เงินมัดจำ : </label>
                  <div class="col-sm-8">
                    <input type="text" name="CashStatusCus" id="CashStatusCus" class="form-control form-control-sm" value="{{ number_format(intval($datacar->CashStatus_Cus), 2) }}" oninput="Comma();"/>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right">หมายเหตุ : </label>
                  <div class="col-sm-8">
                    <textarea name="CusNote" class="form-control form-control-sm form-control form-control-sm-sm" placeholder="ป้อนหมายเหตุ" rows="3">{{$datacar->Note_Cus}}</textarea>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right"><font color="red">สถานะลูกค้า : </font></label>
                  <div class="col-sm-4">
                    <span class="todo-wrap">
                      @if($datacar->Status_Cus == "ติดตาม")
                      <input type="checkbox" id="7" name="StatusCus" value="{{ $datacar->Status_Cus }}" checked="checked"/>
                      @else
                      <input type="checkbox" id="7" name="StatusCus" value="ติดตาม"/>
                      @endif
                      <label for="7" class="todo">
                        <i class="fa fa-check"></i>
                        ติดตาม
                      </label>
                    </span>
                  </div>
                  <div class="col-sm-4">
                    <span class="todo-wrap">
                      @if($datacar->Status_Cus == "จอง")
                      <input type="checkbox" id="8" name="StatusCus" value="{{ $datacar->Status_Cus }}" checked="checked"/>
                      @else
                      <input type="checkbox" id="8" name="StatusCus" value="จอง"/>
                      @endif
                      <label for="8" class="todo">
                        <i class="fa fa-check"></i>
                        จองรถ
                      </label>
                    </span>
                  </div>
                </div>
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right"></label>  
                  <div class="col-sm-4">
                    <span class="todo-wrap">
                      @if($datacar->Status_Cus == "ยกเลิกจอง")
                      <input type="checkbox" id="9" name="StatusCus" value="{{ $datacar->Status_Cus }}" checked="checked"/>
                      @else
                      <input type="checkbox" id="9" name="StatusCus" value="ยกเลิกจอง"/>
                      @endif
                      <label for="9" class="todo">
                        <i class="fa fa-check"></i>
                        ยกเลิกจอง
                      </label>
                    </span>
                  </div>
                  <div class="col-sm-4">
                    <span class="todo-wrap">
                      @if($datacar->Status_Cus == "ส่งมอบ")
                      <input type="checkbox" id="10" name="StatusCus" value="{{ $datacar->Status_Cus }}" checked="checked"/>
                      @else
                      <input type="checkbox" id="10" name="StatusCus" value="ส่งมอบ"/>
                      @endif
                      <label for="10" class="todo">
                        <i class="fa fa-check"></i>
                        ส่งมอบ
                      </label>
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right"><font color="red">ประเภทลูกค้า : </font></label>
                  <div class="col-sm-4">
                    <span class="todo-wrap">
                      @if($datacar->Type_Cus == "Very Hot")
                      <input type="checkbox" id="11" name="TypeCus" value="{{ $datacar->Type_Cus }}" checked="checked"/>
                      @else
                      <input type="checkbox" id="11" name="TypeCus" value="Very Hot"/>
                      @endif
                      <label for="11" class="todo">
                        <i class="fa fa-check"></i>
                        Very Hot
                      </label>
                    </span>
                  </div>
                  <div class="col-sm-4">
                    <span class="todo-wrap">
                      @if($datacar->Type_Cus == "Hot")
                      <input type="checkbox" id="12" name="TypeCus" value="{{ $datacar->Type_Cus }}" checked="checked"/>
                      @else
                      <input type="checkbox" id="12" name="TypeCus" value="Hot"/>
                      @endif
                      <label for="12" class="todo">
                        <i class="fa fa-check"></i>
                        Hot (1-5)
                      </label>
                    </span>
                  </div>
                </div>

                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right"></label>
                  <div class="col-sm-4">
                    <span class="todo-wrap">
                      @if($datacar->Type_Cus == "Warm")
                      <input type="checkbox" id="13" name="TypeCus" value="{{ $datacar->Type_Cus }}" checked="checked"/>
                      @else
                      <input type="checkbox" id="13" name="TypeCus" value="Warm"/>
                      @endif
                      <label for="13" class="todo">
                        <i class="fa fa-check"></i>
                        Warm (6-15)
                      </label>
                    </span>
                  </div>
                  <div class="col-sm-4">
                    <span class="todo-wrap">
                      @if($datacar->Type_Cus == "Cold")
                      <input type="checkbox" id="14" name="TypeCus" value="{{ $datacar->Type_Cus }}" checked="checked"/>
                      @else
                      <input type="checkbox" id="14" name="TypeCus" value="Cold"/>
                      @endif
                      <label for="14" class="todo">
                        <i class="fa fa-check"></i>
                        Cold (มากกว่า 15)
                      </label>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
      </div>
    </div>
  </div>
</div>

<!-- Pop up เพิ่มข้อมูล -->
<div class="modal fade" id="modal-2">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-body">
        <p>One fine body…</p>
      </div>
      <div class="modal-footer justify-content-between">
      </div>
    </div>
  </div>
</div>

{{-- Modal edit tracking --}}
<div class="modal fade" id="modal-3">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <p>One fine body…</p>
      </div>
      <div class="modal-footer justify-content-between">
      </div>
    </div>
  </div>
</div>

{{-- button-to-top --}}
<script>
  $(function () {
    $("#modal-2").on("show.bs.modal", function (e) {
      var link = $(e.relatedTarget).data("link");
      $("#modal-2 .modal-body").load(link, function(){
      });
    });
    $("#modal-3").on("show.bs.modal", function (e) {
      var link = $(e.relatedTarget).data("link");
      $("#modal-3 .modal-body").load(link, function(){
      });
    });
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
  //var id= $('#id_forpic').val();
  $("#image-file").fileinput({
   showUpload: false,
    //uploadUrl:"{{ route('datacar.uploadImg') }}?path={{$datacar->Number_Regist}}&id={{$datacar->id}}",
    uploadUrl:"{{url('/upload-image/'.$datacar->Number_Regist)}}",
    theme:'fa',
    uploadExtraData:function(){
      return{
        _token:"{{csrf_token()}}",
      }
    },
    allowedFileExtensions:['jpg','png','gif'],
    maxFileSize:10240,
    fileActionSettings: {
      showRemove: true,
    showUpload: false, //This remove the upload button
    showZoom: true,
    showDrag: false
  },
});
  $('.confirmdelete').on('click', function () {
    return confirm('Are you sure?');
  });
//   $(document).ready(function(){
//     alert('delete')
//     $("#delete_pic").click(function(){        
//         $("#pic").submit(); // Submit the form
//     });
// });



function deleteBill(id){
  var id_expen =id;
  var _token  = $('input[name="_token"]').val();
    //  if(id_expen!=""){
    //   var url = "{{route('datacar.store')}}";  
    //   var method = "PUT";  
    //  }else{
      var url = "{{route('datacar.destroy',0)}}";  
      var method = "DELETE";  
     //}
  
     swal({
      icon: "warning",
      text: "ต้องการลบ ?",
      buttons: {
        cancel: "ยกเลิก",
        ตกลง: true,
      },
    }).then((value) => {
      if(value){
        $.ajax({
              url : url,
              type : method,
              data:{_token:_token,type:6,id_expen:id_expen},
              dataType: 'JSON',
              success : function(data) {
              
                if (data.flag == 'success') { 
                  $("#form_expen").empty();
                  //  swal("บันทึกข้อมูล เรียบร้อย. !", {
                  //    icon: "success",
                  //    timer: 1000,
                  //  });
                  $("#form_expen").html(data.html);
                }else{
                  //  swal({
                  //    closeOnClickOutside: false,
                  //    icon: "error",
                  //    title: "บันทึกล้มเหลว",
                  //    text: "โปรดตรวจสอบความถูกต้องอีกครั้ง. !",
                  //  });
                  
                }
                $('#modal-3').modal('hide');
                
              }
          });
      }

    });
  }
</script>

@endsection
