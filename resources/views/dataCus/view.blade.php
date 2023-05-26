@extends('layouts.master')
@section('title','Resrearch Cus')
@section('content')



<!-- Main content -->
<section class="content">
  <div class="content-header">
    @if(session()->has('success'))
    <script type="text/javascript">
      toastr.success('{{ session()->get('success') }}')
    </script>
    @endif

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="" style="text-align:center;"><b>Research Customer</b></h4>
            </div>
            <div class="card-body text-sm">
              <div class="row">
                <div class="col-md-12">
                  <form method="get" action="#">
                    <div class="float-right form-inline">
                      <div class="btn-group">
                        <button type="button" class="btn bg-primary btn-app" data-toggle="dropdown">
                          <span class="fas fa-print"></span> ปริ้นรายงาน
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a target="_blank" class="dropdown-item" data-toggle="modal" data-target="#modal-2" data-link="{{ route('ResearchCus', 3) }}"> รายงานข้อมูลลูกค้า</a></li>
                        </ul>
                      </div>
                      <a class="btn bg-success btn-app" data-toggle="modal" data-target="#modal-1" data-backdrop="static" data-link="{{ route('ResearchCus', 2) }}">
                        <i class="fas fa-plus"></i> เพิ่มข้อมูล
                      </a>
                      <button type="submit" class="btn bg-warning btn-app">
                        <span class="fas fa-search"></span> Search
                      </button>
                    </div>
                    <div class="float-right form-inline">
                      <label>จากวันที่ : </label>
                      <input type="date" name="Fromdate" value="{{ ($newfdate != '') ?$newfdate: date('Y-m-d') }}" class="form-control form-control-sm" />
                      
                      <label>ถึงวันที่ : </label>
                      <input type="date" name="Todate" value="{{ ($newtdate != '') ?$newtdate: date('Y-m-d') }}" class="form-control form-control-sm" />
                    </div>
                  </form>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-6 col-12">
                  <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">รายชื่อลูกค้าติดตาม</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                          <i class="fas fa-expand"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-striped table-valign-middle" id="table1">
                          <thead>
                            <tr>
                              <th class="text-center">วันที่</th>
                              <th class="text-center">ชื่อ-สกุล</th>
                              <th class="text-left">เลขทะเบียน</th>
                              <th class="text-left">เซลล์</th>
                              <th class="text-left">สถานะ</th>
                              <th class="text-center" style="width: 70px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key => $row)
                            @if($row->Status_Cus == 'ติดตาม' or $row->Status_Cus == 'ยกเลิกจอง' or $row->Status_Cus == NULL)
                            <tr>
                              <td class="text-center">{{ date('d-m-Y', strtotime($row->DateSale_Cus)) }}</td>
                              <td class="text-left">{{ $row->Name_Cus }}</td>
                              <td class="text-left">{{ $row->RegistCar_Cus }}</td>
                              <td class="text-left">{{ $row->Sale_Cus }}</td>
                              <td class="text-left">
                                @if($row->DateType_Cus != null)
                                @if ($row->Status_Cus == 'ส่งมอบ')
                                <button type="button" class="btn btn-success btn-sm" title="{{ date('d-m-Y', strtotime($row->DateType_Cus)) }}">
                                  <i class="fas fa-user-check"></i> {{ $row->Status_Cus }}
                                </button>
                                @else
                                @if($row->Type_Cus=='Cold'||$row->Type_Cus=='Warm')
                                <button type="button" class="btn btn-primary btn-sm" title="{{ date('d-m-Y', strtotime($row->DateType_Cus)) }}">
                                  <i class="fas fa-user"></i> {{ $row->Type_Cus }}
                                </button>
                                @else
                                <button type="button" class="btn btn-danger btn-sm prem" title="{{ date('d-m-Y', strtotime($row->DateType_Cus)) }}">
                                  <i class="fas fa-fire "></i> {{ $row->Type_Cus }}
                                </button>
                                @endif
                                @endif
                                @endif
                              </td>
                              <td class="text-right">
                                <a href="{{ route('MasterResearchCus.edit',[$row->DataCus_id]) }}?type={{1}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                  <i class="far fa-edit"></i>
                                </a>
                                 @if(auth::user()->position == "Admin" )
                                <form method="post" class="delete_form" action="{{ route('MasterResearchCus.destroy',[$row->DataCus_id]) }}" style="display:inline;">
                                  {{csrf_field()}}
                                  <input type="hidden" name="type" value="1" />
                                  <input type="hidden" name="_method" value="DELETE" />
                                  <button type="submit" data-name="{{ $row->RegistCar_Cus }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                    <i class="far fa-trash-alt"></i>
                                  </button>
                                </form>
                                @endif
                              </td>
                            </tr>
                            @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-sm-6 col-12">
                  <div class="card card-danger">
                    <div class="card-header">
                      <h3 class="card-title">รายชื่อลูกค้าจอง</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                          <i class="fas fa-expand"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-striped table-valign-middle" id="table2">
                          <thead>
                            <tr>
                              <th class="text-center">วันที่</th>
                              <th class="text-center">ชื่อ-สกุล</th>
                              <th class="text-center">เลขทะเบียน</th>
                              <th class="text-center">เซลล์</th>
                              <th class="text-center">สถานะสัญญา</th>
                              <th class="text-center">วันที่สัญญา</th> 
                              <th class="text-center" style="width: 70px"></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key => $row)
                            @if($row->Status_Cus == 'จอง')
                            <tr>
                              <td class="text-center">{{ date('d-m-Y', strtotime($row->DateSale_Cus)) }}</td>
                              <td class="text-left">{{ $row->Name_Cus }}</td>
                              <td class="text-left">{{ $row->RegistCar_Cus }}</td>
                              <td class="text-left">{{ $row->Sale_Cus }}</td>
                              <td class="text-left">
                                @php
                                echo $row->Status_cont;
                               @endphp
                             </td>
                             <td class="text-center">{{$row->Contract_Date }}</td>
                              <!--<td class="text-left">
                                 @if($row->DateType_Cus != null)
                                @if ($row->Status_Cus == 'ส่งมอบ')
                                <button type="button" class="btn btn-success btn-sm" title="{{ date('d-m-Y', strtotime($row->DateType_Cus)) }}">
                                  <i class="fas fa-user-check"></i> {{ $row->Status_Cus }}
                                </button>
                                @else                                                   
                                @if($row->Type_Cus=='Cold'||$row->Type_Cus=='Warm')
                                <button type="button" class="btn btn-primary btn-sm" title="{{ date('d-m-Y', strtotime($row->DateType_Cus)) }}">
                                  <i class="fas fa-user"></i> {{ $row->Type_Cus }}
                                </button>
                                @else
                                <button type="button" class="btn btn-danger btn-sm prem" title="{{ date('d-m-Y', strtotime($row->DateType_Cus)) }}">
                                  <i class="fas fa-fire "></i> {{ $row->Type_Cus }}
                                </button>
                                @endif
                                @endif
                                @endif 
                              </td>-->
                              <td class="text-right">
                                <a href="{{ route('MasterResearchCus.edit',[$row->DataCus_id]) }}?type={{1}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                  <i class="far fa-edit"></i>
                                </a>
                                @if(auth::user()->position == "Admin" )
                                <form method="post" class="delete_form" action="{{ route('MasterResearchCus.destroy',[$row->DataCus_id]) }}" style="display:inline;">
                                  {{csrf_field()}}
                                  <input type="hidden" name="type" value="1" />
                                  <input type="hidden" name="_method" value="DELETE" />
                                  <button type="submit" data-name="{{ $row->RegistCar_Cus }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                    <i class="far fa-trash-alt"></i>
                                  </button>
                                </form>
                                @endif
                              </td>
                            </tr>
                            @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <a id="button"></a>
          </div>
        </div>
      </div>
    </section>
  </div>
</section>

<div class="modal fade" id="modal-2">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="card card-warning">
          <div class="card-header">
            <h4 class="card-title">รายงานข้อมูลลูกค้า</h4>
            <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
        </div>
      </div>
      <div class="modal-body text-sm">
        <form target="_blank" action="{{ action('ResearchCusController@ReportCus',1) }}" method="post">
          @csrf
          
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
          <div class="row">
            <div class="col-12 text-center">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" id="inlineRadio1" value="1">
                <label class="col-form-label" for="inlineRadio1">รายงานข้อมูลลูกค้า</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="2">
                <label class="col-form-label" for="inlineRadio2">รายงานสรุป</label>
              </div>
              @if(auth::user()->position == "Admin")
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="3">
                <label class="col-form-label" for="inlineRadio2">ประมาณการการขาย</label>
              </div>
              <!-- <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="4">
                <label class="col-form-label" for="inlineRadio2">รายงานลูกค้า</label>
              </div> -->
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="5">
                <label class="col-form-label" for="inlineRadio2">ส่งมอบ</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="6">
                <label class="col-form-label" for="inlineRadio2">สถานะขาย</label>
              </div>
              @endif
            </div>                                  
          </div>
        </div>
        <br>

        <div class="card-footer text-center">
          <button type="submit" class="btn bg-warning btn-app">
            <i class="fas fa-print"></i> print
          </button>
          <a class="btn btn-app bg-danger" href="{{ URL::previous() }}" >
            <i class="fas fa-times"></i> ยกเลิก
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

<!-- Pop up เพิ่มข้อมูล -->
<div class="modal fade" id="modal-1">
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

<!-- Pop up รายงาน -->
<!--     <div class="modal fade" id="modal-2">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <p>One fine body…</p>
                </div>
                <div class="modal-footer justify-content-between">
                </div>
            </div>
        </div>
      </div> -->

      <script>
        $(function () {
          $("#table1,#table2").DataTable({
             "responsive": true,
          "autoWidth": false,
          "lengthChange": true,
          "order": [[ 1, "asc" ]],
          "pageLength": 10,
          "dom": 'Blfrtip',
          "buttons": [
              'excel', 'print'
          ]
          });
        });
      </script>

      {{-- Popup --}}
      <script>
        $(function () {
          $("#modal-1").on("show.bs.modal", function (e) {
            var link = $(e.relatedTarget).data("link");
            $("#modal-1 .modal-body").load(link, function(){
            });
          });
        });
        // $(function () {
        //   $("#modal-2").on("show.bs.modal", function (e) {
        //     var link = $(e.relatedTarget).data("link");
        //     $("#modal-2 .modal-body").load(link, function(){
        //     });
        //   });
        // });
      </script>

    <!-- <script>
        function blinker() {
            $('.prem').fadeOut(1);
            $('.prem').fadeIn(1);
        }
        setInterval(blinker, 1);
      </script> -->
      @endsection
