  @php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $Y2 = date('Y') + 542;
  $m = date('m');
  $d = date('d');
  //$date = date('Y-m-d');
  $time = date('H:i');
  $date = $Y.'-'.$m.'-'.$d;
  $date2 = $Y2.'-'.'01'.'-'.'01';
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
  <section class="content">
    <div class="card card-success">
      <div class="card-header">
        <h4 class="card-title"><b>เพิ่มข้อมูลขาย...</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form name="form1" method="post" action="{{ action('DatacarController@updateinfo',$id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card-body text-sm">
          <div class="row">
            <div class="col-md-12">
              <script>
                 function addCommas(x) {
                    var parts = x.toString().split(".");
                    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    return parts.join(".");
                }  
                

                function comma(){
                  var num11 = $('#NetPriceplus').val();
                  var num1 = num11.replace(",","");
                  var num22 = $('#AmountPrice').val();
                  var num2 = num22.replace(",","");
                  var num33 = $('#DownPrice').val();
                  var num3 = num33.replace(",","");
                  var num44 = $('#TransferPrice').val();
                  var num4 = num44.replace(",","");
                  var num55 = $('#SubdownPrice').val();
                  var num5 = num55.replace(",","");
                  var num66 =  $('#InsurancePrice').val();
                  var num6 = num66.replace(",","");
                  var num77 =  $('#CashStatus_Cus').val();
                  var num7 = num77.replace(",","");
                  var num8  =   parseFloat(num3);       
                  var topcar = parseFloat(num1)-parseFloat(num8)-parseFloat(num5);

                 //  $('#NetPriceplus').val(addCommas(num11));
                 //  $('#AmountPrice').val(addCommas(num2));
                 // $('#DownPrice').val(addCommas(num3));
                 // $('#TransferPrice').val(addCommas(num4));
                 //  $('#SubdownPrice').val(addCommas(num5));
                 //  $('#InsurancePrice').val(addCommas(num6));
                 

                  if(!isNaN(topcar)){
                     $('#TopcarPrice').val(addCommas(topcar));
                  
                  }
                }
              </script>

              <div class="row">
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">วันที่ขาย :</label>
                    <div class="col-sm-8">
                      <input type="date" class="form-control form-control-sm" name="DateSoldoutplus" value="{{ $datacar->Date_Soldout_plus }}" />
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
                    <label class="col-sm-3 col-form-label text-right">ราคาขาย :</label>
                    <div class="col-sm-8">
                      <input type="text" id="NetPriceplus" name="NetPriceplus" class="form-control form-control-sm" placeholder="ป้อนราคาขาย" value="{{ number_format($datacar->Net_Priceplus, 2) }}" onkeyup="comma();" />
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">นายหน้า :</label>
                    <div class="col-sm-8">
                      <input type="text" name="NameAgent" class="form-control form-control-sm" placeholder="ป้อนชื่อนายหน้า" value="{{ $datacar->Name_Agent }}"/>
                    </div>
                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">Vat Car :</label>
                    <div class="col-sm-8">
                      <select name="Vat_car_sale" class="form-control form-control-sm">
                        <option value="" >---เลือกประเภท---</option>
                        <option value="ก่อนVat" {{ ($datacar->Vat_car_sale=='ก่อนVat') ? 'selected' : '' }}>ก่อนVat</option>
                         <option value="รวมVat" {{ ($datacar->Vat_car_sale=='รวมVat') ? 'selected' : '' }}>รวมVat</option>
                         <option value="ไม่มีVat" {{ ( $datacar->Vat_car_sale=='ไม่มีVat') ? 'selected' : '' }}>ไม่มีVat</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">งบเหลือเก็บ :</label>
                    <div class="col-sm-8">
                       <input type="text" id="Balance_Budget" name="Balance_Budget" class="form-control form-control-sm"  value="{{number_format($datacar->Balance_Budget,2)}}" placeholder="ราคาต้นทุน"   />
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">ประเภทการขาย :</label>
                    <div class="col-sm-8">
                      <select name="TypeSale" class="form-control form-control-sm">
                        <option value="" selected>---เลือกประเภท---</option>
                        @foreach ($arrayTypeSale as $key => $value)
                        <option value="{{$key}}" {{ ($key == $datacar->Type_Sale) ? 'selected' : '' }}>{{$value}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">Sale ขาย :</label>

                    <div class="col-sm-8">
                      @if(auth::user()->position=='SALE')
                      <input type="text" name="NameSaleplus"  value="{{auth::user()->username}}" class="form-control form-control-sm" placeholder="ป้อน Sale" />
                      @else
                      <select name="NameSaleplus" class="form-control form-control-sm" required>
                        @foreach ($user as $key2 => $value2)
                        <option value="{{$value2->username}}"  {{ ($datacar->Name_Saleplus == $value2->username) ? 'selected' : '' }}>{{$value2->name}}</option>
                        @endforeach

                      </select>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              @php
              $buyer_n='';
              $buyer_t='';
              if($datacar->F_DataCus_id==NULL){
                if($datacar->Name_Buyer!=Null){
                  $buyer_n=$datacar->Name_Buyer;
                  $buyer_t=$datacar->Tel_Buyer;
                }
              }else{

                $buyer_n=$datacar->Name_Cus;
                $buyer_t=$datacar->Phone_Cus;

              }
              @endphp
              <div class="row">
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">ผู้ซื้อ :</label>
                    <div class="col-sm-8">
                      <input type="text" name="NameBuyer" class="form-control form-control-sm" placeholder="ป้อนชื่อผู้ซื้อ" value="{{ $buyer_n }}"  />
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">ประเภทการขาย :</label>
                    <div class="col-sm-8">
                      <select name="Type_Ofsale" class="form-control form-control-sm">
                        <option value="" >---เลือกประเภท---</option>
                        <option value="บริษัท" {{ ($datacar->Type_Ofsale=='บริษัท') ? 'selected' : '' }}>บริษัท</option>
                        <option value="SV" {{ ($datacar->Type_Ofsale=='SV') ? 'selected' : '' }}>SV</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">เบอร์โทรผู้ซื้อ:</label>
                    <div class="col-sm-8">
                      <input type="text" name="PhoneCus" class="form-control form-control-sm" placeholder="เบอร์โทรผู้ซื้อ" value="{{  $buyer_t }}"  />
                    </div>
                  </div>
                </div>
                <div class="col-6">
                 <div class="form-group row mb-1">
                  <label class="col-sm-3 col-form-label text-right">ค่าแนะนำ :</label>
                  <div class="col-sm-8">
                    <input type="text" id="IntroPrice" name="IntroPrice" class="form-control form-control-sm" oninput="sum();" value="{{number_format($datacar->Intro_Price,2)}}" placeholder="ราคาต้นทุน"   />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-1">
                  <label class="col-sm-3 col-form-label text-right">ไฟเเนนซ์ :</label>
                  <div class="col-sm-8">
                    <select name="FinanceName" class="form-control form-control-sm">
                      <option value="" >---เลือกประเภท---</option>

                      <option value="ธนชาติ" {{ ($datacar->Finance_Name=='ธนชาติ') ? 'selected' : '' }}>ธนชาติ</option>
                      <option value="ทิสโก้" {{ ($datacar->Finance_Name=='ทิสโก้') ? 'selected' : '' }}>ทิสโก้</option>
                      <option value="SCB" {{ ($datacar->Finance_Name=='SCB') ? 'selected' : '' }}>SCB</option>
                      <option value="กรุงศรี ออโต้" {{ ($datacar->Finance_Name=='กรุงศรี ออโต้') ? 'selected' : '' }}>กรุงศรี ออโต้</option>
                      <option value="ชูเกียรติ" {{ ($datacar->Finance_Name=='ชูเกียรติ') ? 'selected' : '' }}>ชูเกียรติ</option>
                      <option value="เกียรตินาคิน" {{ ($datacar->Finance_Name=='เกียรตินาคิน') ? 'selected' : '' }}>เกียรตินาคิน</option>
                      <option value="กสิกรลิสซิ่ง" {{ ($datacar->Finance_Name=='กสิกรลิสซิ่ง') ? 'selected' : '' }}>กสิกรลิสซิ่ง</option>
                      <option value="สด" {{ ($datacar->Finance_Name=='สด') ? 'selected' : '' }}>สด</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-6">
               <div class="form-group row mb-1">
                <label class="col-sm-3 col-form-label text-right">ค่าพิเศษไฟแนนซ์ :</label>
                <div class="col-sm-8">
                  <input type="text" id="SpecialPrice" name="SpecialPrice" class="form-control form-control-sm" oninput="sum();" value="{{number_format($datacar->Special_Price,2)}}" placeholder="ค่าพิเศษไฟแนนซ์"   />
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group row mb-1">
                <label class="col-sm-3 col-form-label text-right">งวดการผ่อน :</label>
                <div class="col-sm-8">
                  <select name="FinanceInstal" class="form-control form-control-sm">
                    <option value="" selected>---เลือกประเภท---</option>
                    <option value="24" {{ ($datacar->Finance_Instal=='24') ? 'selected' : '' }}>24</option>
                    <option value="36" {{ ($datacar->Finance_Instal=='36') ? 'selected' : '' }}>36</option>
                    <option value="48" {{ ($datacar->Finance_Instal=='48') ? 'selected' : '' }}>48</option>
                    <option value="60" {{ ($datacar->Finance_Instal=='60') ? 'selected' : '' }}>60</option>
                    <option value="72" {{ ($datacar->Finance_Instal=='72') ? 'selected' : '' }}>72</option>
                    <option value="84" {{ ($datacar->Finance_Instal=='84') ? 'selected' : '' }}>84</option>

                  </select>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group row mb-1">
                <label class="col-sm-3 col-form-label text-right">ค่าพิเศษLiger :</label>
                <div class="col-sm-8">
                  <input type="text" id="LigerPrice" name="LigerPrice" class="form-control form-control-sm" oninput="sum();" value="{{number_format($datacar->Liger_Price,2)}}" placeholder="ราคาต้นทุน"   />
                </div>
              </div> 
            </div>    
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group row mb-1">
                <label class="col-sm-3 col-form-label text-right">คอมฝ่ายขาย :</label>
                <div class="col-sm-8">
                  <input type="text" id="comendSale" name="comendSale" class="form-control form-control-sm"  value="{{number_format($datacar->comendSale,2)}}" placeholder="ราคาต้นทุน"   />
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group row mb-1">
                <label class="col-sm-3 col-form-label text-right">คอมAdmin :</label>
                <div class="col-sm-8">
                  <input type="text" id="comendAdmin" name="comendAdmin" class="form-control form-control-sm"  value="{{number_format($datacar->comendAdmin,2)}}" placeholder="ราคาต้นทุน"   />
                </div>
              </div> 
            </div>    
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group row mb-1">
                <label class="col-sm-3 col-form-label text-right">Margin ส่วนแบ่ง :</label>
                <div class="col-sm-8">
                  <input type="text" id="Margin_allocation" name="Margin_allocation" class="form-control form-control-sm"  value="{{$datacar->Margin_allocation}}" placeholder="ราคาต้นทุน"   />
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group row mb-1">
                <label class="col-sm-3 col-form-label text-right">คอมFinance :</label>
                <div class="col-sm-8">
                  <input type="text" id="comendFinance" name="comendFinance" class="form-control form-control-sm"  value="{{number_format($datacar->comendFinance,2)}}" placeholder="ราคาต้นทุน"   />
                </div>
              </div> 
            </div> 
          </div>

          <hr>
          <div class="card card-warning card-tabs">
            <div class="card-header p-0 pt-1">
              <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="Sub-custom-tab4" data-toggle="pill" href="#Sub-tab4" role="tab" aria-controls="Sub-tab1" aria-selected="false">ยอด</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="Sub-custom-tab5" data-toggle="pill" href="#Sub-tab5" role="tab" aria-controls="Sub-tab2" aria-selected="false">อื่นๆ</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="Sub-custom-tab6" data-toggle="pill" href="#Sub-tab6" role="tab" aria-controls="Sub-tab3" aria-selected="false">รายการของแถม</a>
                </li>
              </ul>
            </div>

            <div class="tab-content">
              <div class="tab-pane fade show active" id="Sub-tab4" role="tabpanel" aria-labelledby="Sub-custom-tab4">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">เงินดาวน์ :</label>
                      <div class="col-sm-8">
                        <input type="text" id="DownPrice" name="DownPrice" class="form-control form-control-sm" placeholder="ป้อนเงินดาวน์" value="{{number_format($datacar->Down_Price,2) }}" onkeyup="comma();"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">อัตราดอกเบี้ย :</label>
                      <div class="col-sm-8">
                        <input type="text" id="Increase" name="Increase" class="form-control form-control-sm" placeholder="อัตราดอกเบี้ย" value="{{ $datacar->Increase }}"  />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">เงินมัดจำ :</label>
                      <div class="col-sm-8">
                        <input type="text" id="CashStatus_Cus" name="CashStatus_Cus" class="form-control form-control-sm" placeholder="เงินมัดจำ" value="{{ number_format($datacar->CashStatus_Cus,2) }}" onkeyup="comma();"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">ยอดผ่อน/เดือน :</label>
                      <div class="col-sm-8">
                        <input type="text" id="Month_Balance" name="Month_Balance" class="form-control form-control-sm" placeholder="ป้อนค่าประกัน" value="{{ number_format($datacar->Month_Balance,2) }}" onkeyup="comma();"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">ซับดาวน์ :</label>
                      <div class="col-sm-8">
                        <input type="text" id="SubdownPrice" name="SubdownPrice" class="form-control form-control-sm" placeholder="ป้อนซับดาวน์" value="{{ number_format($datacar->Subdown_Price,2) }}" onkeyup="comma();"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">ค่าใช้จ่ายโอน :</label>
                      <div class="col-sm-8">
                        <input type="text" id="TransferPrice" name="TransferPrice" class="form-control form-control-sm" placeholder="ป้อนค่าใช้จ่ายโอน" value="{{ number_format($datacar->Transfer_Price,2) }}" onkeyup="comma();"/>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right"><font color="red"> ยอดจัด :</font></label>
                      <div class="col-sm-8">
                        <input type="text" id="TopcarPrice" name="TopcarPrice" class="form-control form-control-sm" placeholder="ป้อนยอดจัด" value="{{ number_format($datacar->Topcar_Price,2) }}" readonly/>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">ค่าประกัน (PA) :</label>
                      <div class="col-sm-8">
                        <input type="text" id="InsurancePrice" name="InsurancePrice" class="form-control form-control-sm" placeholder="ป้อนค่าประกัน" value="{{ number_format($datacar->Insurance_Price,2) }}" onkeyup="comma();"/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade show" id="Sub-tab5" role="tabpanel" aria-labelledby="Sub-custom-tab5">
                <div class="table-responsive text-sm">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">วันที่เงินเข้า :</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control form-control-sm" name="DateWithdraw"  value="{{ $datacar->Date_Withdraw }}"  />
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">จำนวนเงิน :</label>
                        <div class="col-sm-8">
                          <input type="text" id="AmountPrice" name="AmountPrice" class="form-control form-control-sm" placeholder="ป้อนจำนวนเงิน" value="{{ number_format($datacar->Amount_Price, 2) }}" onkeyup="comma();" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">วันที่เซ็นสัญญา :</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control form-control-sm" name="Contract_Date" value="{{ $datacar->Contract_Date }}" />
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">วันที่อนุมัติ PO :</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control form-control-sm" name="Po_Date"  value="{{ $datacar->Po_Date }}"  />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">วันที่ส่งมอบรถ :</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control form-control-sm" name="SendCar_Date"  value="{{ $datacar->SendCar_Date }}" />
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">วันที่FirmCase :</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control form-control-sm" name="FirmCase"  value="{{ $datacar->FirmCase }}"  />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">หมายเหตุ :</label>
                        <div class="col-sm-8">
                          <textarea class="form-control" name="Remark_FN">{{$datacar->Remark_FN}}</textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-1">
                        <label class="col-sm-3 col-form-label text-right">วันที่ออกใบเสร็จ :</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control form-control-sm" name="Date_invoice"  value="{{ $datacar->Date_invoice }}"  />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade show" id="Sub-tab6" role="tabpanel" aria-labelledby="Sub-custom-tab6">
                <div class="table-responsive text-sm">
                  <div class="col-md-12"> 
                    @php
                    if($datacar->Gift_Set!=NULL||$datacar->Gift_Set!=''){
                      $gift = explode(',',$datacar->Gift_Set);
                    }else{
                      $gift = array();
                    }
                    @endphp

                    <div class="" id="todo-list">
                      <div class="row">
                        <div class="col-md-2">
                          <span class="todo-wrap">
                            <input type="checkbox" id="insure" name="gift[]" value="ประกัน2+" {{ (in_array('ประกัน2+', $gift)) ? 'checked' : '' }} />
                            <label for="insure" class="todo">
                              <i class="fa fa-check"></i>
                              ประกัน2+
                            </label>
                          </span>
                        </div>
                        <div class="col-md-2">
                          <span class="todo-wrap">
                            <input type="checkbox" id="act" name="gift[]"{{ (in_array('พรบ.', $gift)) ? 'checked' : '' }}  value="พรบ." />
                            <label for="act" class="todo">
                              <i class="fa fa-check"></i>
                              พรบ.
                            </label>
                          </span>
                        </div>
                        <div class="col-md-2">
                          <span class="todo-wrap">
                            <input type="checkbox" id="regis" name="gift[]" value="ทะเบียน" {{ (in_array('ทะเบียน', $gift) ) ? 'checked' : '' }} />
                            <label for="regis" class="todo">
                              <i class="fa fa-check"></i>
                              ทะเบียน
                            </label>
                          </span>
                        </div>
                        <div class="col-md-2">
                          <span class="todo-wrap">
                            <input type="checkbox" id="fee" name="gift[]" value="ค่าโอน" {{ (in_array('ค่าโอน', $gift) ) ? 'checked' : '' }} />
                            <label for="fee" class="todo">
                              <i class="fa fa-check"></i>
                              ค่าโอน
                            </label>
                          </span>
                        </div>
                        <div class="col-md-2">
                          <span class="todo-wrap">
                            <input type="checkbox" id="oil" name="gift[]" value="น้ำมัน" {{ (in_array('น้ำมัน', $gift) ) ? 'checked' : '' }} />
                            <label for="oil" class="todo">
                              <i class="fa fa-check"></i>
                              น้ำมัน
                            </label>
                          </span>
                        </div>
                        <div class="col-md-2">
                          <span class="todo-wrap">
                            <input type="checkbox" id="frame" name="gift[]" value="กรอบป้ายทะเบียน" {{ (in_array('กรอบป้ายทะเบียน', $gift) ) ? 'checked' : '' }} />
                            <label for="frame" class="todo">
                              <i class="fa fa-check"></i>
                              กรอบป้ายทะเบียน
                            </label>
                          </span>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <span class="todo-wrap">
                            <input type="checkbox" id="proof" name="gift[]" value="พ่นกันสนิม" {{ (in_array('พ่นกันสนิม', $gift) ) ? 'checked' : '' }} />
                            <label for="proof" class="todo">
                              <i class="fa fa-check"></i>
                              พ่นกันสนิม
                            </label>
                          </span>
                        </div>
                        <div class="col-md-2">
                          <span class="todo-wrap">
                            <input type="checkbox" id="3m" name="gift[]" value="เคลือบสี 3M" {{ (in_array('เคลือบสี 3M', $gift) ) ? 'checked' : '' }} />
                            <label for="3m" class="todo">
                              <i class="fa fa-check"></i>
                              เคลือบสี 3M
                            </label>
                          </span>
                        </div>
                        <div class="col-md-2">
                          <span class="todo-wrap">
                            <input type="checkbox" id="en_oil" name="gift[]" value="เปลี่ยนถ่ายน้ำมันเครื่อง" {{ (in_array('เปลี่ยนถ่ายน้ำมันเครื่อง', $gift) ) ? 'checked' : '' }} />
                            <label for="en_oil" class="todo">
                              <i class="fa fa-check"></i>
                              เปลี่ยนถ่ายน้ำมันเครื่อง
                            </label>
                            <input type="date" name="oil_free" placeholder="วันวันที่ถ่ายน้ำมันเครื่อง" class="form-control form-control-sm"  value="{{$datacar->oil_free}}">
                          </span>
                        </div>
                        <div class="col-md-3">
                          <span class="todo-wrap">
                            <input type="checkbox" id="other" name="gift[]" value="อื่นๆ" {{ (in_array('อื่นๆ', $gift) ) ? 'checked' : '' }}  />
                            <label for="other" class="todo">
                              <i class="fa fa-check"></i>
                              อื่นๆ
                            </label> 
                            <div id="otherS" style="display: none;">
                              <textarea type="text" id="otherText" name="otherGift" class="form-control" rows="3" placeholder="อื่นๆ" >{{ $datacar->otherGift }}</textarea>
                            </div>   
                          </span>
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
    @php

    //if ($reserch == '1'){
      //if($datacar->Name_Buyer==NULL && $datacar->F_DataCus_id==NULL){
        @endphp
        <div class="box-footer">
          <div class="form-group" align="center">
            <button type="submit" class="delete-modal btn btn-success">
              <span class="glyphicon glyphicon-floppy-save"></span> บันทึก
            </button>
            <a class="delete-modal btn btn-danger" href="{{ URL::previous() }}">
              <span class="glyphicon glyphicon-remove"></span> ยกเลิก
            </a>
          </div>
        </div>
        @php
     // }
      @endphp
      <input type="hidden" name="_method" value="PATCH"/>
    </form>
  </div>
</section>
<script type="text/javascript">
  $('#other').click(function() {
    $("#otherS").toggle(this.checked);
  });


</script>
