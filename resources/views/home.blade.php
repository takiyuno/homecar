@extends('layouts.master')
@section('title','Home')
@section('content')

@if (session('status'))
<div class="alert alert-success" role="alert">
  {{ session('status') }}
</div>
@endif

<div class="card">
  <div class="card-header">
    <div class="pricing-header px-3 py-3 pt-md-3 pb-md-0 mx-auto text-center">
      <!-- <div class="card-tools">
        <a class="btn bg-danger btn-app float-right" data-toggle="modal" data-target="#modal-1" data-link="{{ route('datacar', 13) }}" data-backdrop="static" data-keyboard="false" style="border-radius: 10px;">
          <span class="fas fa-balance-scale  fa-5x"></span> <label >เทียบราคา</label>
        </a>
      </div> -->
      {{-- <div align="center">
        <img class="img-responsive" src="{{ asset('dist/img/homecar.png') }}" alt="User Image" style = "width: 40%">
      </div> --}}
    </div>
  </div>
   
  <div class="card-body">
    <div class="row">
        @if(auth::user()->position == "Admin" || auth::user()->position =="Staff" )
      <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$data1-$data6}}</h3>
            <p>รถยนต์ในสต็อกทั้งหมด (ไม่รวมที่ขาย) </p>
          </div>
          <div class="icon">
            <i class="fa fa-car fa-5x"></i>
          </div>
          <a href="{{ route('datacar', 1) }}" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-4 col-6">
        <div class="small-box bg-green ">
          <div class="inner">
            <h3>{{ $data0}}</h3>
            <p>รถยนต์นำเข้าใหม่</p>
          </div>
          <div class="icon">
            <i class="fa fa-car fa-5x"></i>
          </div>
          <a href="{{ route('datacar', 7) }}" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      @endif
      <div class="col-lg-4 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$data5}}</h3>
              <p>รถยนต์พร้อมขาย</p>
            </div>
            <div class="icon">
              <i class="fab fa-bitcoin"></i>
            </div>
            <a href="{{ route('datacar', 5) }}" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      
      
    </div>
@if(auth::user()->position == "Admin" || auth::user()->position =="Staff")
    <div class="row">
      <div class="col-lg-4 col-6">
        <div class="small-box bg-purple">
          <div class="inner">
            <h3>{{$data2}}</h3>
            <p>รถยนต์ระหว่างทำสี</p>
          </div>
          <div class="icon">
            <i class="fa fa-paint-brush fa-5x"></i>
          </div>
          <a href="{{ route('datacar', 2) }}" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-4 col-6">
        <div class="small-box bg-navy">
          <div class="inner">
            <h3>{{$data3}}</h3>
            <p>รถยนต์รอซ่อม</p>
          </div>
          <div class="icon">
            <i class="fas fa-car-crash"></i>
          </div>
          <a href="{{ route('datacar', 3) }}" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-4 col-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><font color="white">{{$data4}}</font></h3>
            <p><font color="white">รถยนต์ระหว่างซ่อม</font></p><font>
            </div>
            <div class="icon">
              <i class="fa fa-wrench fa-5x"></i>
            </div>
            <a href="{{ route('datacar', 4) }}" class="small-box-footer"><font color="white">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></font></a>
          </div>
        </div>
      </div>
    @endif
      <div class="row">

        <div class="col-lg-4 col-6">
          <div class="small-box bg-danger ">
            <div class="inner">
              <h3>{{$data7->sumExpire}}</h3>
              <p>บัตรหมดอายุ</p>
              @php
              if($data7->sumExpire>0){
                $style_s = 'style=color:yellow;';
              }else{
                $style_s = '';
              }
              @endphp
            </div>
            <div class="icon" {{$style_s}} >
              <i class="fas fa-exclamation-triangle "></i>
            </div>
            <a href="{{ route('reportcar', 4) }}" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$data8}}</h3>
              <p>บันทึกการติดตาม</p>
             
            </div>
            <div class="icon">
              <i class="fas fa-rss-square"></i>
            </div>
            <a href="{{ route('ResearchCus3', 2) }}" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        @if(auth::user()->position == "Admin" || auth::user()->position =="Staff" )
      <div class="col-lg-4 col-6">
          <div class="small-box bg-gray">
            <div class="inner">
              <h3>{{$data6}}</h3>
              <p>รถยนต์ที่ขายแล้ว</p>
            </div>
            <div class="icon">
              <i class="fas fa-cart-arrow-down"></i>
            </div>
            <a href="{{ route('datacar', 6) }}" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
          </div>
      </div>
      @endif
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-1">
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

  <!-- <script>
    function blinker() {
      $('.prem').fadeOut(1500);
      $('.prem').fadeIn(1500);
    }
    setInterval(blinker, 1500);
  </script> -->

  {{-- Popup --}}
  <script>
    $(function () {
      $("#modal-1").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-1 .modal-body").load(link, function(){
        });
      });
    });
  </script>
  @endsection
