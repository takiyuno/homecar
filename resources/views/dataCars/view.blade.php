@extends('layouts.master')
@section('title','ข้อมูลรถยนต์มือ 2')
@section('content')

@php
function DateThai($strDate)
{
  $strYear = date("Y",strtotime($strDate));
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("d",strtotime($strDate));
  $strMonthCut = Array("" , "ม.ค","ก.พ","มี.ค","เม.ย","พ.ค","มิ.ย","ก.ค","ส.ค","ก.ย","ต.ค","พ.ย","ธ.ค");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strDay $strMonthThai $strYear";
  //return "$strDay-$strMonthThai-$strYear";
}
@endphp

@php
date_default_timezone_set('Asia/Bangkok');
$Y = date('Y');
$m = date('m');
$d = date('d');
//$date = date('Y-m-d');
$time = date('H:i');
$date = $Y.'-'.$m.'-'.$d;
@endphp

<!-- Main content -->
<section class="content">
  <div class="content-header">
    @if(session()->has('success'))
    <script type="text/javascript">
      toastr.success('{{ session()->get('success') }}')
    </script>
    @endif

    <section class="content">
      <div class="row  justify-content-center">
        <div class="col-12 table-responsive">
          <div class="card">
            <div class="card-header">
              <h5><b>รายการ{{$title}}</b></h5>
            </div>
            <div class="card-body text-sm">
              {{-- ส่วนหัว --}}
              
              <div class="row">
                <div class="col-md-12">
                  <form method="get" action="{{ route('datacarin',$type) }}">
                    <div class="float-right form-inline">
                    
                      <a href="{{ route('datacarin.create',1) }}" class="btn bg-success btn-app">
                        <span class="fas fa-plus"></span> เพิ่มข้อมูล
                      </a>
                    
                      <a href="#" data-toggle="modal" data-target="#modal-4" class="btn bg-primary btn-app" data-backdrop="static" data-keyboard="false">
                        <span class="fas fa-print"></span> ปริ้นรายการ
                      </a>
                      
                      <button type="submit" class="btn bg-warning btn-app">
                        <span class="fas fa-search"></span> Search
                      </button>
                    </div>

                    <div class="float-right form-inline">

                      <!-- <label for="text" class="mr-sm-0">ประเภท :</label>
                      <select name="carType" class="form-control form-control-sm">
                        <option selected value="">---เลือกประเภทรถ---</option>
                        <option value="1" {{ ($carType == '1') ? 'selected' : '' }}>รถยนต์ทั้งหมด</option>
                        <option value="2" {{ ($carType == '2') ? 'selected' : '' }}>รถตรวจสอบเเล้ว</option>
                        <option value="3" {{ ($carType == '3') ? 'selected' : '' }}>รถรอนำเข้า</option>
                      </select> -->
                      
                      <label>จากวันที่ : </label>
                      <input type="date" name="Fromdate" value="{{ ($fdate != '') ?$fdate: date('Y-m-d') }}" class="form-control form-control-sm" />
                      <label>ถึงวันที่ : </label>
                      <input type="date" name="Todate" value="{{ ($tdate != '') ?$tdate: date('Y-m-d') }}" class="form-control form-control-sm" />
                    </div>
                  </form>
                </div>
              </div>


              {{-- เนื้อหา --}}

              <div class="table-responsive">
                <table id="table1" class="table table-hover">
                  <thead>
                    <tr>
                      <th class="text-center" style="width: 100px">วันที่รับ</th>
                      <!-- <th class="text-center" style="width: 120px">วันที่เปลี่ยนสถานะ</th> -->
                      <th class="text-center" style="width: 100px">ชื่อลูกค้า</th>
                      <th class="text-center" style="width: 100px">เบอร์โทรศัพท์</th>
                      <th class="text-center" style="width: 100px">เลขทะเบียน</th>
                      <th class="text-center" style="width: 100px">ยี่ห้อรถ</th>
                      <th class="text-center" style="width: 100px">รุ่นรถ</th>
                      <th class="text-center" style="width: 70px">Sale Name</th>
                      <th class="text-center" style="width: 80px">ประเภทรถ</th>
                      <th class="text-center" style="width: 80px">ไฟเเนนซ์</th>
                      @php
                        if($type == 2 || $type == 3 ){
                      @endphp
                       <th class="text-center" style="width: 80px">สถานะรถ</th>
                      <th class="text-center" style="width: 80px">วันที่ปิดไฟเเนนซ์</th>
                      <th class="text-center" style="width: 80px">ยอดปิด</th>
                      <th class="text-center" style="width: 80px">หมายเหตุ</th>
                      @php
                    }
                   
                        if($type == 3 ){
                      @endphp
                      <th class="text-center" style="width: 80px">วันนัดดูรถ</th>
                       <th class="text-center" style="width: 80px">วันทีรับรถ</th>
                      @php
                    }
                      @endphp

                      <th style="width: 120px"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $row)
                      @php
                        $create_date = date_create($row->Date_Car_in);

                        if($row->Status_Car_in1 == '4'){
                          $bg_c='style=background-color:#c2e8c2;';
                        }else{
                          $bg_c='';
                        }
                      @endphp
                    <tr {{$bg_c}}>                      
                      <td class="text-center">
                        {{ date_format($create_date, 'd-m-Y')}}
                      </td>

                      @if($row->Date_Status_car == Null)
                      <!-- <td class="text-center"> - </td> -->
                      @else
                     <!--  <td class="text-center">{{ date_format(date_create($row->Date_Status_car), 'd-m-Y')}}</td> -->
                      @endif
                      <td class="text-center">{{ $row->Name_Cus_in }}</td>
                      <td class="text-left">{{$row->Tel_Cus_in}}</td>
                      <td class="text-center">{{ $row->Nameid_Car_in }}</td>
                      <td class="text-center">{{ $row->Brand_Car_in }}</td>
                      <td class="text-center">{{ $row->Version_Car_in }}</td>
                      <td class="text-center">{{ $row->Sale_Name }}</td>
                      <td class="text-center">
                        @if($row->Return_car == 1)
                        CKL
                        @elseif ($row->Return_car  == 2)
                        รถประมูล
                        @elseif ($row->Return_car  == 3)
                        รถยึด
                        @elseif ($row->Return_car  == 4)
                        ฝากขาย
                        @elseif ($row->Return_car  == 5)
                        เทิร์นรถใหม่
                        @elseif ($row->Return_car  == 6)
                        เทิร์นรถมือสอง
                        @elseif ($row->Return_car  == 7)
                        ซื้อหน้าเต็นท์
                        @endif
                      </td>
                      @php
                        if($row->StatusFN_Car_in != 'other'){
                          $textFN = $row->StatusFN_Car_in;
                        }else{
                          $textFN = $row->Other_FN;
                        }
                      @endphp
                      <td class="text-center">{{  $textFN }}</td>
                      @php
                        if($type == 2 || $type == 3){
                      if($row->Status_Car_in == 'yes'){
                            $s_text = 'จอง';
                          }else{
                            $s_text = 'ไม่จอง';
                          }
                          @endphp
                      <th class="text-center" style="width: 80px">{{ $s_text }}</th>   
                      
                       <th class="text-center" style="width: 80px">{{$row->DateFN}}</th>
                      <th class="text-center" style="width: 80px">{{number_format($row->TotalFN, 2)}}</th>
                      <th class="text-center" style="width: 80px">{{ $row->Status_Detail }}</th>
                      @php
                    }
                      if($type == 3 ){
                      @endphp
                      <th class="text-center" style="width: 80px">{{ $row->Date_See_Car }}</th>
                      <th class="text-center" style="width: 80px">{{ $row->Date_Carry_in }}</th>
                      @php
                    }
                      @endphp
              

                      <td class="text-right">

                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default" title="ดูรายการ"
                        data-link="{{ action('DataCarsInController@viewsee',[$row->id,$row->Status_Car_in1]) }}">
                        <i class="far fa-eye"></i>
                      </button>
                      
                        @if($row->Status_Car_in1 != '4')
                      
                      <a href="{{ action('DataCarsInController@edit',[$row->id,$row->Status_Car_in1,$type]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                        <i class="far fa-edit"></i> 
                      </a>
                      @endif
                      @if(auth::user()->position == "Admin" && $row->Datacar_id == NULL)
                            <form method="post" class="delete_form" action="{{ action('DataCarsInController@destroy',$row->id) }}" style="display:inline;">
                              {{csrf_field()}}
                              <input type="hidden" name="_method" value="DELETE" />
                              <input type="hidden" name="type" value="1" />
                              <button type="submit" data-name="{{ $row->id }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                <i class="far fa-trash-alt"></i>
                              </button>
                            </form>
                            @endif
                            @php
                       // }
                      @endphp
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>

              <a id="button"></a>
            </div>
          </div>
        </section>
      </div>
    </section>

    <div class="modal fade" id="modal-4">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body">
            <div class="card card-warning">
              <div class="card-header">
                <h4 class="card-title">รายงานสต็อกรถยนต์</h4>
                <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
            </div>
          </div>
          <div class="modal-body text-sm">
            <form target="_blank" action="{{ action('DataCarsInController@ReportExcel') }}" method="post">
              @csrf
              <input type="hidden" name="type" value="1">
              <div class="row">
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">จากวันที่ : </label>
                    <div class="col-sm-8">
                      <input type="date" id="Fromdate" name="Fromdate" value="{{ date('Y-m-d') }}" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-3 col-form-label text-right">ถึงวันที่ : </label>
                    <div class="col-sm-8">
                      <input type="date" id="Todate" name="Todate" value="{{ date('Y-m-d') }}" class="form-control" />
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-3">
                  @if(auth::user()->position != "SALE")
                 <div class="form-check">
                  <input class="form-check-input" type="radio" name="report" id="flexRadioDefault1" value="mgr">
                  <label for="flexRadioDefault1">
                    Trade In Report
                  </label>
                </div>
                @endif
              </div>
              <div class="col-sm-3">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="report" id="flexRadioDefault2" value="sale">
                  <label  for="flexRadioDefault2">
                    Trade In Report For Sale
                  </label>
                </div>
              </div>
            </div>
           
            <input type="hidden" name="type" value="{{$type}}">
            <div class="card-footer text-center">
              <button type="submit" class="btn bg-warning btn-app">
                <i class="fas fa-print"></i> print
              </button>
              <a class="btn btn-app bg-danger" href="{{ route('datacarin',1) }}">
                <i class="fas fa-times"></i> ยกเลิก
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  


  <!-- Pop up รายละเอียดค่าใช้จ่าย -->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-xl">
      <div class="modal-content bg-default">
        <div class="modal-body">
          <p>One fine body…</p>
        </div>
        <div class="modal-footer justify-content-between">
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-buyinfo">
    <div class="modal-dialog modal-xl">
      <div class="modal-content bg-default">
        <div class="modal-body">
          <p>One fine body…</p>
        </div>
        <!-- <div class="modal-footer justify-content-between">
        </div> -->
      </div>
    </div>
  </div>

  {{-- Popup --}}
  <script>
    $(function () {
      $("#modal-default").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-default .modal-body").load(link, function(){
        });
      });

      $("#modal-buyinfo").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-buyinfo .modal-body").load(link, function(){
        });
      });
    });
  </script>
  
  {{-- button-to-top --}}
  <script>
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

  <script>
    $(function () {
      $.fn.dataTable.moment("DD-MM-YYYY");
      $('#table1').DataTable({
         "responsive": true,
          "autoWidth": false,
          "lengthChange": true,
          "order": [[ 0, "DESC" ]],
          "pageLength": 10,
          "dom": 'Blfrtip',
          "buttons": [
              'excel', 'print'
          ]
      });
    });
  </script>
  @endsection
