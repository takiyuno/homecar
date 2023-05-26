<section class="content">
  <div class="card card-warning">
    <div class="card-header">
      <h4 class="card-title">
        <i class="fas fa-chalkboard-teacher"></i>&nbsp;
        บันทึกการติดตาม (Tracking Customer)
      </h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>

    <form name="form1" action="{{ route('MasterResearchCus.update',[$id]) }}" method="post" id="formimage" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="card-body text-sm">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label><font color="red">วันที่ : </font></label>
            <input type="date" name="DateTrack" class="form-control form-control-sm" value="{{ date('Y-m-d') }}"/>
          </div>
          <div class="form-group col-md-6">
            <label><font color="red">สรุปสถานะ : </font></label>
            <select name="StatusTrack" class="form-control form-control-sm" required>
              <option value="" selected> --------- เลือกสถานะ -------- </option>
              <option value="ติดตามต่อไป">ติดตามต่อไป</option>
              <option value="ยกเลิกการติดตาม">ยกเลิกการติดตาม</option>
              <option value="ยกเลิกจอง">ยกเลิกจอง</option>
              <option value="ปิดการขาย/ส่งมอบ">ปิดการขาย/ส่งมอบ</option>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label>บันทึกการติดตาม (Sale): </label>
            <textarea name="FollowTrack" class="form-control" rows="3" placeholder="Enter ..."></textarea>
          </div>
          @if(auth::user()->position == "Admin" )
          <div class="form-group col-md-6">
            <label>หมายเหตุ (ผู้จัดการ): </label>
            <textarea name="NoteTrack" class="form-control" rows="3" placeholder="Enter ..."></textarea>
          </div>
          @endif
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
      <div class="row">
        @php
        $track_in = DB::table('tracking_cuses')
        ->where('F_DataCus_id','=',$id)
        ->get();
        $no=1;
        @endphp
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-valign-middle" id="table1">
              <thead>
                <tr>
                  <th class="text-left">ครั้งที่</th>
                  <th class="text-left">บันทึกการติดตาม SALE</th>
                  <th class="text-left">หมายเหตุ (ผู้จัดการ)</th>
                  <th class="text-left">Sale Name</th>
                  <th class="text-left"></th>

                </tr>
              </thead>
              <tbody>
                @foreach($track_in as $key2 => $row2)

                <tr>
                  <td class="col-1">{{ $no }}</td>
                  <td class="text-left col-5">{{ $row2->Follow_Tracking }}</td>
                  <td class="text-left col-5">{{ $row2->Note_tracking }}</td>
                  <td class="text-left col-3">{{ $row2->User_Tracking }}</td>
                  <td class="text-left">

                   <a class="btn btn-warning btn-sm" title="แก้ไขรายการ" data-toggle="modal" data-target="#modal-2" data-backdrop="static" data-link="{{ route('MasterResearchCus.edit',[$row2->Tracking_id]) }}?type={{3}}">
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

    <input type="hidden" name="type" value="2"/>
    <input type="hidden" name="_method" value="PATCH"/>
  </form>
</div>
</section>

<script>
  $(function () {
    $('[data-mask]').inputmask()
  })
</script>


