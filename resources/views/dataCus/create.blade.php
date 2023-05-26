<style>
#todo-list{
  width:100%;
  margin:0 auto 50px auto;
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
  border-radius:5px;
}
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
  height:3px;
  position:relative;
}
.todo:before{
  content:'';
  display:block;
  position:absolute;
  top:calc(96% + 10px);
  left:0;
  width:0%;
  height:1px;
  background:#cd4400;
  /*transition*/
 /* -webkit-transition:.25s ease-in-out;
    -moz-transition:.25s ease-in-out;
      -o-transition:.25s ease-in-out;
      transition:.25s ease-in-out;*/
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
    <div class="card card-warning">
      <div class="card-header">
        <h4 class="card-title">
          <i class="fas fa-car"></i>&nbsp;
          ข้อมูลลูกค้า
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <form name="form1" action="{{ route('MasterResearchCus.store') }}" method="post" id="formimage" enctype="multipart/form-data">
        @csrf
        <div class="card-body text-sm">
          <h5 class="text-center"><b>แบบฟอร์มข้อมูลลูกค้า</b></h5>
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
            function Comma(){
              var num11 = document.getElementById('CashStatusCus').value;
              var num1 = num11.replace(",","");

              document.form1.CashStatusCus.value = addCommas(num1);
            }
          </script>

          <div>
            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right">ชื่อ - นามสกุล : </label>
                  <div class="col-sm-8">
                    <input type="text" name="NameCus" class="form-control form-control-sm" placeholder="ป้อนชื่อ-นามสกุล" required/>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right">เบอร์ติดต่อ : </label>
                  <div class="col-sm-8">
                    <input type="text" name="PhoneCus" class="form-control form-control-sm" placeholder="ป้อนเบอร์ติดต่อ" data-inputmask="&quot;mask&quot;:&quot;999-9999999&quot;" data-mask=""/>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right">เลขบัตร ปชช. : </label>
                  <div class="col-sm-8">
                    <input type="text" name="IDCardCus" class="form-control form-control-sm" placeholder="ป้อนเลขบัตรประชาชน" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" />
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right">ที่อยู่ : </label>
                  <div class="col-sm-8">
                    <input type="text" name="AddressCus" class="form-control form-control-sm" placeholder="ป้อนที่อยู่" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right">จังหวัด/ไปรษณีย์ : </label>
                  <div class="col-sm-4">
                    <input type="text" name="ProvinceCus" class="form-control form-control-sm" placeholder="ป้อนจังหวัด" />
                  </div>
                  <div class="col-sm-4">
                    <input type="text" name="ZipCus" class="form-control form-control-sm" placeholder="ป้อนรหัสไปรษณีย์" data-inputmask="&quot;mask&quot;:&quot;99999&quot;" data-mask=""/>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right">Email : </label>
                  <div class="col-sm-8">
                    <input type="text" name="EmailCus" class="form-control form-control-sm" placeholder="ป้อนอีเมลล์" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-0">
                  <label class="col-sm-3 col-form-label text-right">อาชีพ : </label>
                  <div class="col-sm-8">
                    <input type="text" name="CareerCus" class="form-control form-control-sm" placeholder="ป้อนอาชีพ" />
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row mb-1">
                  <label class="col-sm-3 col-form-label text-right">ยี่ห้อรถ :</label>
                  <div class="col-sm-8">
                    <select name="BrandCarUse" class="form-control form-control-sm" >
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
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-1">
                  <label class="col-sm-3 col-form-label text-right">แหล่งที่มาลูกค้า : </label>
                  <div class="col-sm-8">
                    <select name="OriginCus" class="form-control form-control-sm">
                      <option value="1">ป้ายโฆษณา/รถแห่/วิทยุ/จดหมาย</option>
                      <option value="2">ลูกค้าไฟแนนซ์เก่า/ลูกค้าซื้อขายเก่า</option>
                      <option value="3">นายหน้า</option>
                      <option value="4">ศูนย์บริการ</option>
                      <option value="5">FB บริษัท</option>
                      <option value="6">FB ส่วนตัว</option>
                      <option value="7">Line บริษัท</option>
                      <option value="8">Walk In</option>
                      <option value="9">Call In</option>
                      <option value="11">ลูกค้าเก่าแนะนำ</option>
                      <option value="10">อื่นๆ</option>
                    </select>
                  </div>
                </div>
              </div>
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
           <!--  <div class="col-6">
              <div class="form-group row mb-1">
                <label class="col-sm-3 col-form-label text-right">รูปแบบลูกค้า : </label>
                <div class="col-sm-8">
                  <select name="modelCus" class="form-control form-control-sm">
                    <option value="" selected>--- เลือกรูปแบบ ---</option>
                    <option value="Walk In">Walk In</option>
                    <option value="Call In">Call In</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
              </div>
            </div> -->
          </div>

          <div class="row">
            <div class="col-6">
              <div class="form-group row mb-0">
                <label class="col-sm-3 col-form-label text-right"><font color="red">วันที่รับลูกค้า : </font></label>
                <div class="col-sm-8">
                  <input type="date" name="DateSaleCus" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" placeholder="ลงวันที่" required/>
                </div>
              </div>
              <div class="form-group row mb-0">
                <label class="col-sm-3 col-form-label text-right">เงินมัดจำ : </label>
                <div class="col-sm-8">
                  <input type="text" name="CashStatusCus" id="CashStatusCus" class="form-control form-control-sm" placeholder="เงินมัดจำ" oninput="Comma();"/>
                </div>
              </div>
              <div class="form-group row mb-0">
                <label class="col-sm-3 col-form-label text-right">ชื่อSale : </label>
                <div class="col-sm-8">
                  @if(auth::user()->position=='SALE')
                 <input type="text" name="SaleCus" value="{{auth::user()->username }}" class="form-control form-control-sm" placeholder="ผู้เสนอราคา" />
                  @else
                   <select name="SaleCus" class="form-control form-control-sm" required>
                      @foreach ($user as $key => $value)
                        <option value="{{$value->username}}">{{$value->username}}</option>
                        @endforeach
                          
                    </select>
                 @endif
               </div>
             </div>
           </div>
           <div class="col-6">
            <div class="form-group row mb-1">
              <label class="col-sm-3 col-form-label text-right">เกียร์รถ / ปีรถ :</label>
              <div class="col-sm-4">
                <select name="GearcarUse" class="form-control form-control-sm">
                  <option value="">-----เลือกเกียร์รถ------</option>
                  <option value="MT">MT</option>
                  <option value="AT">AT</option>
                </select>
              </div>
              <div class="col-sm-4">
                <input type="text" name="YearCarUse" class="form-control form-control-sm"  placeholder="ป้อนปีที่ผลิต"/>
              </div>
            </div>
            <div class="form-group row mb-0">
              <label class="col-sm-3 col-form-label text-right">หมายเหตุ : </label>
              <div class="col-sm-8">
                <textarea name="CusNote" class="form-control form-control-sm" placeholder="ป้อนหมายเหตุ" rows="3"></textarea>
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
                  <input type="radio" id="1" name="StatusCus" value="ติดตาม" checked />
                  <label for="1" class="todo">
                    <i class="fa fa-check"></i>
                    ติดตาม
                  </label>
                </span>
              </div>
              <div class="col-sm-4">
                <span class="todo-wrap">
                  <input type="radio" id="2" name="StatusCus" value="จอง"/>
                  <label for="2" class="todo">
                    <i class="fa fa-check"></i>
                    จองรถ
                  </label>
                </span>
              </div>
            </div>

          </div>
          <div class="col-6">
            <div class="form-group row mb-0">
              <label class="col-sm-3 col-form-label text-right"><font color="red">ประเภทลูกค้า : </font></label>
              <!-- <div class="col-sm-4">
                <span class="todo-wrap">
                  <input type="radio" id="5" name="TypeCus" value="Very Hot"/>
                  <label for="5" class="todo">
                    <i class="fa fa-check"></i>
                    Very Hot
                  </label>
                </span>
              </div> -->
              <div class="col-sm-4">
                <span class="todo-wrap">
                  <input type="radio" id="6" name="TypeCus" value="Hot"/>
                  <label for="6" class="todo">
                    <i class="fa fa-check"></i>
                    Hot (ออกรถในเดือน)
                  </label>
                </span>
              </div>
            </div>
            <div class="form-group row mb-1">
              <label class="col-sm-3 col-form-label text-right"></label>
              <div class="col-sm-4">
                <span class="todo-wrap">
                  <input type="radio" id="7" name="TypeCus" value="Warm"/>
                  <label for="7" class="todo">
                    <i class="fa fa-check"></i>
                    Warm (1-2เดือน)
                  </label>
                </span>
              </div>
              <div class="col-sm-4">
                <span class="todo-wrap">
                  <input type="radio" id="8" name="TypeCus" value="Cold" checked="true" />
                  <label for="8" class="todo">
                    <i class="fa fa-check"></i>
                    Cold (ยังไม่มีแพลน)
                  </label>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card card-warning card-tabs">
        <div class="card-header p-0 pt-1">
          <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="Sub-custom-tab1" data-toggle="pill" href="#Sub-tab1" role="tab" aria-controls="Sub-tab1" aria-selected="false">รถที่จอง</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " id="Sub-custom-tab2" data-toggle="pill" href="#Sub-tab2" role="tab" aria-controls="Sub-tab2" aria-selected="false">สอบถามทั่วไป Sale</a>
            </li>
          </ul>
        </div>

        <div class="tab-content">
          <div class="tab-pane fade show active" id="Sub-tab1" role="tabpanel" aria-labelledby="Sub-custom-tab1">
            <div>
              <p></p>
              <div class="row">
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">เลขทะเบียน : </label>
                    <div class="col-sm-8">
                      <select name="RegisterCar" id="RegisterCar" class="form-control form-control-sm RegisterCar select2 ">
                        <option value="" selected>--- เลขทะเบียน ---</option>
                        @foreach ($data as $key => $value)
                        <option value="{{$value->id}}">{{$value->Number_Regist}}</option>
                        @endforeach
                      </select>
                      <span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="10"></span>
                    </div>
                  </div>
                </div>
              </div>

              <div id="ShowData"></div>
            </div>
            <p></p>
          </div>
          <div class="tab-pane fade show" id="Sub-tab2" role="tabpanel" aria-labelledby="Sub-custom-tab2">
            <div class="table-responsive text-sm">
              <p></p>
              <div class="row">
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">เรื่องที่สอบถาม  : </label>
                    <div class="col-sm-8">
                      <input type="text" name="talkTitle" value="" class="form-control form-control-sm" placeholder="เรื่องที่สอบถาม" />
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">ประวัติลูกค้า :</label>
                    <div class="col-sm-8">
                      <select name="cusLoneStatus" class="form-control form-control-sm" >
                        <option value="" selected>--- เลือกประวัติลูกค้า ---</option>
                        <option value="ประวัติดี">ประวัติดี</option>
                        <option value="มีประวัติ แต่ล่าช้า">มีประวัติ แต่ล่าช้า</option>
                        <option value="ไม่มีประะวัติ">ไม่มีประะวัติ</option>
                        <option value="ติดBL">ติดBL</option>                  
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">รถที่เคยใช้งาน :</label>
                    <div class="col-sm-8">
                      <select name="BrandCar" class="form-control form-control-sm" >
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
                        <option value="ไม่มีรถ">ไม่มีรถ</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">เคยมีประวัติผ่อนที่ไหน : </label>
                    <div class="col-sm-8">
                      <input type="text" name="instalDetail" value="" class="form-control form-control-sm" placeholder="เคยมีประวัติผ่อนที่ไหน" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">รายได้ฉลี่ยต่อเดือน :</label>
                    <div class="col-sm-8">
                      <select name="cusIncome" class="form-control form-control-sm" >
                        <option value="" selected>--- รายได้ฉลี่ยต่อเดือน ---</option>
                        <option value="9,000-15,000">9,000-15,000</option>
                        <option value="15,001-25,000">15,001-25,000</option>
                        <option value="25,001-30,000">25,001-30,000</option>
                        <option value="มากกว่า 30,000">มากกว่า 30,000</option>
                        <option value="ไม่มีรายได้">ไม่มีรายได้</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">รถเทิร์น :</label>
                    <div class="col-sm-8">
                      <span class="todo-wrap">
                        <input type="radio" id="cusTurnCar" name="cusTurnCar" value="มี"/>
                        <label for="cusTurnCar" class="todo">
                          <i class="fa fa-check"></i>
                          มี
                        </label>
                        <div id="showTurn" style="display:none">
                          <input type="text" name="cusTurnCarText" value="" class="form-control form-control-sm" placeholder="ระบุรุ่นรถที่เทิร์น" />
                        </div>
                      </span>

                      <span class="todo-wrap">
                        <input type="radio" id="cusTurnCar2" name="cusTurnCar" value="ไม่มี"/>
                        <label for="cusTurnCar2" class="todo">
                          <i class="fa fa-check"></i>
                          ไม่มี
                        </label>
                      </span>

                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card-tools d-inline float-right">
              <button type="submit" class="delete-modal btn btn-success">
                <i class="fas fa-save"></i> บันทึก
              </button>
              <a class="delete-modal btn btn-danger" href="{{ URL::previous() }}">
                <i class="far fa-window-close"></i> ยกเลิก
              </a>
            </div>
          </div>
        </div>

        <input type="hidden" name="type" value="1">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
      </div>
    </form>
  </div>
</section>

<script>
  $(function () {
    $('[data-mask]').inputmask()
  })
</script>

<script type="text/javascript">
  $('.RegisterCar').change(function() {
    if ($(this).val() != '') {
      
      var select = $(this).val();
      // console.log(select);
      var _token = $('input[name="_token"]').val();

      $.ajax({
        url:"{{ route('ResearchCus.SearchData', 1) }}",
        method:"POST",
        data:{select:select,_token:_token},

        success:function(result){ //เสร็จแล้วทำอะไรต่อ
          $('#ShowData').html(result);
        }
      })
    }
  });

  $('input[name="cusTurnCar"]').on('change',function(){
    
    if($(this).attr('value')=="มี")
    {
     $('#showTurn').show();
     
   }
   else
   {
     $('#showTurn').hide();
     
   }
 });
$(document).ready(function() {
    $(document).find("input:checked[type='radio']").addClass('bounce');   
    $("input[type='radio']").click(function() {
        $(this).prop('checked', false);
        $(this).toggleClass('bounce');

        if( $(this).hasClass('bounce') ) {
            $(this).prop('checked', true);
            $(document).find("input:not(:checked)[type='radio']").removeClass('bounce');
        }
    });
});

</script>


