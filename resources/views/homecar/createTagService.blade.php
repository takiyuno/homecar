<style>
  input[type="radio"]{
    display: none;
  } 
  input[type="radio" i]{
    margin: 3px 0.5ex;
  }
  input[type="radio"] + label{
    text-align: center;
    color: rgb(228, 72, 72);
  }
  input[type="radio"]:checked + label{
    color: #FFF;
    background-color: rgba(231, 153, 117, 0.925);
    border: 1px solid rgba(231, 153, 117, 0.925);
  }
  .check-item {
    height: 40px;
    vertical-align: middle;
    /*text-transform: uppercase;*/
    letter-spacing: 1px;
    color: rgb(255, 255, 255);
    border: 1px solid rgba(0, 0, 0, .1);
    padding-left: 7px;
    padding-right: 7px;
    padding-top: 8px;
    padding-bottom: 8px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;

  }
</style>

<section class="content" style="font-family: 'Prompt', sans-serif;">
  <form id="createTagParts" class="form-Validate"  enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="type" value="6"/>
    <input type="hidden" name="Car_id" id="Car_id" value="{{@$Car_id}}"/>
    <input type="hidden" name="id_expen" id="id_expen" value="{{@$data->id}}"/>
    <div class="card card-info card-outline textSize-13">
      <div class="card-header">
        <h6 class="card-title" style="font-size: 13px;">เพิ่มสถานะ <span class="small">(New Tag Details)</span></h6>
        <div class="card-tools">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 15pt;margin-bottom: -25pt">
            <span aria-hidden="true">x</span>
          </button>
        </div>
      </div>
      <div class="card-body"> 
        <div class="row">
          {{-- <div class="col-md-12">
            <div class="text-center ">
              <p class="col-sm-4 col-form-label text-right">วันที่ : </p>
              <div class="col-sm-4">
                <input type="date"name="date_bill" value="{{date('Y-m-d')}}" class="form-control form-control-sm textSize-13" required/>
              </div>
            </div>
          </div> --}}
          <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="description-block">
              <div >
                <div class="row">
                  <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group row mb-0">
                      <p class="col-sm-4 col-form-label text-right">วันที่ : </p>
                      <div class="col-sm-6">
                        <input type="date"name="date_bill" value="{{@$data->date_bill==''?date('Y-m-d'):@$data->date_bill}}" class="form-control form-control-sm textSize-13" required/>
                      </div>
                    </div>
                    <div class="form-group row mb-0">
                      <p class="col-sm-4 col-form-label text-right">รายการซ่อม : </p>
                      <div class="col-sm-6">
                        <input type="text" name="text_expen" value="{{@$data->text_expen}}" class="form-control form-control-sm textSize-13" required/>
                      </div>
                       
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group row mb-0">
                      <p class="col-sm-4 col-form-label text-right">สถานะ : </p>
                      <div class="col-sm-6">
                        <select class="form-control form-control-sm textSize-13" name="type_expen" id="type_expen"  required>
                          <option value="">--เลือกสถานะ--</option>                       
                          <option value="ซ่อม" {{@$data->type_expen=='ซ่อม'?'selected':''}}>ซ่อม</option>
                          <option value="ทำสี" {{@$data->type_expen=='ทำสี'?'selected':''}}>ทำสี</option>
                          <option value="อื่นๆ" {{@$data->type_expen=='อื่นๆ'?'selected':''}}>อื่นๆ</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row mb-0">
                     <p class="col-sm-4 col-form-label text-right">ราคา : </p>
                      <div class="col-sm-6">
                        <input type="text" name="price" id="price" value="{{@$data->price}}"  class="form-control form-control-sm textSize-13" required/>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group row mb-0">
                      <p class="col-sm-4 col-form-label text-right">รายละเอียด : </p>
                      <div class="col-sm-6">
                        <textarea name="remark" id="remark" class="form-control form-control-sm textSize-13" rows="3" required>{{@$data->remark}}</textarea>
                      </div>
                    </div>
                    <div class="form-group row mb-0">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row float-right">
      <div class="col-12">
        <button type="button" id="TagPart" class="btn btn-success btn-sm textSize-13 hover-up">
          <i class="fas fa-download"></i> บันทึก
        </button>
      </div>
    </div>
  </form>
</section>
<script>
  $('#TagPart').click(function(){
    var data = $('#createTagParts').serialize();
     var _token = $('input[name="_token"]').val();
     var id_expen =$('#id_expen').val();
    //  if(id_expen!=""){
    //   var url = "{{route('datacar.store')}}";  
    //   var method = "PUT";  
    //  }else{
      var url = "{{route('datacar.store')}}";  
      var method = "POST";  
     //}
  
     $.ajax({
           url : url,
           type : method,
           data: data,
           dataType: 'JSON',
           success : function(data) {
            console.log(data.request);
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
     
  });
</script>