  <section class="content">
    <div class="row">
      <div class="col-lg-8 col-md-6 col-sm-6">
        <h6><b>รายละเอียดค่าใช้จ่าย</b></h6>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="float-right">

          <button type="button" data-toggle="modal" data-target="#modal-3" data-link="{{ route('MasterDatacar.show',6) }}?Car_id={{@$id}}&type=6" class="btn btn-tool btn-outline-secondary" title="เพิ่มรายการ" >
            <i class="fas fa-plus"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="table-responsive textSize-13">
      <table class="table table-hover text-nowrap " id="table1">
        <thead>
          <tr>
            <th class="text-center" style="width: 10px">ลำดับ</th>
            <th class="text-center" style="width: 50px">วันที่ใบเสร็จ</th>
            <th class="text-center" style="width: 50px">สถานะ</th>
            <th class="text-center" style="width: 150px">รายการซ่อม</th>
            <th class="text-center" style="width: 50px">ราคา</th>
            <th class="text-center" style="width: 50px">remark</th>
            <th class="text-right" style="width: 5%"></th>
          </tr>
        </thead>
        <tbody>
          <input type="hidden" name="_token" value="{{csrf_token()}}" />
          @if (!empty(@$data->dataCarToExpen))
            @foreach(@$data->dataCarToExpen as $key => $value)
              <tr>
                <td class="text-center">{{$key+1}}</td>
                <td class="text-center">{{ date('d-m-Y', strtotime($value->date_bill)) }}</td>
                <td class="text-left ">
                  {{$value->type_expen}}
                </td>
                <td class="text-left" >{{@$value->text_expen}}</td>
                <td class="text-right" >{{$value->price}}</td>
                <td class="text-right" >{{$value->remark}}</td>
                <td class="text-right">
                  <a  data-toggle="modal" data-target="#modal-3" data-link="{{ route('MasterDatacar.show', $value->id) }}?Car_id={{@$data->id}}&type=7" class="btn btn-warning btn-xs hover-up " title="แก้ไข">
                    <i class="far fa-edit fa-sm"></i> 
                  </a>
                  <a target="_blank" href="{{ route('MasterDatacar.show',[$value->id]) }}?type={{2}}&car_id={{$value->Car_id}}" class="btn btn-info btn-sm hover-up" title="พิมพ์ใบเสร็จ">
                    <i class="fas fa-print"></i>
                  </a>
                <button  type="button" onclick="deleteBill({{$value->id}})" class="btn btn-danger btn-tool " >
                    <i class="fa fa-trash fa-sm btn-danger "></i> 
                </button>
                </td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </section>
  <script>
    $(function () {


$("#table1,#myTable").DataTable({
  "responsive": true,
  "searching": true,
         "autoWidth": false,
         "lengthChange": false,
         "order": [[ 0, "asc" ]],
         "pageLength": 5,
         "dom": 'Blfrtip',
         "buttons": [
             'excel', 'print'
         ]


});
});
  </script>