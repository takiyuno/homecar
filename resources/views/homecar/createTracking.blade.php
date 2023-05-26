<section class="content">
  <div class="card card-warning">
    <div class="card-header">
      <h4 class="card-title">
        <i class="fas fa-chalkboard-teacher"></i>&nbsp;
        บันทึกการติดตามงานซ่อม (Tracking Service)
      </h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    @if(auth::user()->position != "SALE" )
    <form name="form1" action="{{ route('datacar.trackingCars',[$id,$type,0]) }}" method="post" id="formimage" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="card-body text-sm">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label><font color="red">วันที่ : </font></label>
            <input type="date" name="track_date" class="form-control form-control-sm" min="{{date('Y-m-d')}}" value="{{ date('Y-m-d') }}"/>
          </div>
          <div class="form-group col-md-6">
            <label><font color="red">สถานะ : </font></label>
            <select name="status_car" class="form-control form-control-sm" required>
              <option value="" selected> --------- เลือกสถานะ -------- </option>
              <option value="2" >รถยนต์ระหว่างทำสี</option>
              <option value="3" >รถยนต์รอซ่อม</option>
              <option value="4" >รถยนต์ระหว่างซ่อม</option>
             
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label>บันทึกการงานซ่อม: </label>
            <textarea name="detail_car" class="form-control" rows="3" placeholder="Enter ..."></textarea>
          </div>
           <div class="form-group col-md-6">
            <label><font color="red">กำหนดเสร็จ : </font></label>
            <input type="date" name="end_date" class="form-control form-control-sm" min="{{date('Y-m-d')}}" value=""/>
          </div>
         
          <!-- <div class="form-group col-md-6">
            <label>หมายเหตุ (ผู้จัดการ): </label>
            <textarea name="NoteTrack" class="form-control" rows="3" placeholder="Enter ..."></textarea>
          </div> -->
          
        </div>
      </div>
      <div class="card-footer text-center">
        <button type="submit" class="delete-modal btn btn-success">
          <i class="fas fa-save"></i> บันทึก
        </button>
        <a class="delete-modal btn btn-danger" href="{{ URL::previous() }}">
          <i class="far fa-window-close"></i> ยกเลิก
        </a>
      </div>
        <input type="hidden" name="_method" value="GET"/>
  </form>
  @endif
      @if($type2=='15')
      <div class="row">
        @php
        $track_in = DB::table('tracking_cars')
        ->where('id_cars','=',$id)
        ->get();
        $no=1;
        @endphp
        <div class="card-body">
          <div class="table-responsive">
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
                  @if(auth::user()->position != "SALE" )
                   <a class="btn btn-warning btn-sm" title="แก้ไขรายการ" data-toggle="modal" data-target="#modal-3" data-backdrop="static" data-link="{{ route('datacar.trackingCars',[ $row2->id,0,16]) }}">
                    <i class="far fa-edit"></i>
                  </a>
                  @endif
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
    @endif
  
</div>
</section>

<script>
  $(function () {
    $('[data-mask]').inputmask()
  })
</script>


