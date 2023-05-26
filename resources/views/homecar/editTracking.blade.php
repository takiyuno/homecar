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

    <form name="form1" action="{{ route('datacar.trackingCars',[$id,$type,0]) }}" method="post" id="formimage" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="card-body text-sm">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label><font color="red">วันที่ : </font></label>
            <input type="date" name="track_date" class="form-control form-control-sm" min="{{date('Y-m-d')}}" value="{{ $tracking->track_date }}"/>
          </div>
          <div class="form-group col-md-6">
            <label><font color="red">สถานะ : </font></label>
            <select name="status_car" class="form-control form-control-sm" required>
              <option value="" selected> --------- เลือกสถานะ -------- </option>
              <option value="2" {{ ($tracking->status_car == '2') ? 'selected' : '' }}>รถยนต์ระหว่างทำสี</option>
              <option value="3" {{ ($tracking->status_car == '3') ? 'selected' : '' }}>รถยนต์รอซ่อม</option>
              <option value="4" {{ ($tracking->status_car == '4') ? 'selected' : '' }}>รถยนต์ระหว่างซ่อม</option>
             
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label>บันทึกการงานซ่อม: </label>
            <textarea name="detail_car" class="form-control" rows="3" placeholder="Enter ...">{{$tracking->detail_car}}</textarea>
          </div>
           <div class="form-group col-md-6">
            <label><font color="red">กำหนดเสร็จ : </font></label>
            <input type="date" name="end_date" class="form-control form-control-sm" min="{{date('Y-m-d')}}" value="{{$tracking->end_date}}"/>
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
</div>
</section>

<script>
  $(function () {
    $('[data-mask]').inputmask()
  })
</script>


