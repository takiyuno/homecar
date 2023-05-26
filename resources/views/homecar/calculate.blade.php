
 <script type="text/javascript">
    var price_car= parseFloat({{$datacar->Net_Price}});
    var price_net = (price_car);
    $('#Price_car').val(price_net);
    //alert(price_net);
    function addCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}  

function roundUp(num, precision) {
  precision = Math.pow(10, precision)
  return Math.ceil(num * precision) / precision
}
    function calcu(){

       var car_price1 = parseFloat($("#Price_car").val());
       var down_payment1 = parseFloat($("#down_payment1").val());
       var down_payment_percent1 = parseFloat($("#down_payment_percent1").val());
       var installments_period1 = parseFloat($("#installments_period1").val());
       var interest_rate_percent1 = parseFloat($("#interest_rate_percent1").val());

      var buy_loan1 =((car_price1-down_payment1)*1.07);
      var year = (installments_period1/12);
       var interest = ((buy_loan1*interest_rate_percent1)/100)*year;
        var loan_per_month1 = (interest+buy_loan1)/installments_period1;
//buy_loan1loan_per_month1

      $('#buy_loan1').val(addCommas(parseFloat((buy_loan1).toFixed(2))));


      $('#loan_per_month1').val(addCommas(parseFloat((loan_per_month1).toFixed(2))));
        //$('#loan_per_month1').val(addCommas(Math.ceil(loan_per_month1,-1)));
  
    }
    $('#down_payment_percent1').on('keyup',function(){

      var car_price1 = parseFloat($("#Price_car").val());
      var down_payment_percent1 = parseFloat($("#down_payment_percent1").val());
      var down = (car_price1*down_payment_percent1)/100;
       //$('#down_payment1').prop('readonly', true);
      $('#down_payment1').val(parseFloat((down).toFixed(2)));

    });
    $('#down_payment1').on('keyup',function(){
      var car_price1 = parseFloat($("#Price_car").val());
      var down_payment = parseFloat($("#down_payment1").val());
      var down = (down_payment/car_price1)*100;
      //$('#down_payment_percent1').prop('readonly', true);
      $('#down_payment_percent1').val(parseFloat((down).toFixed(2)));

    });
    $('#price_bank').on('change',function(){

        var v_bank = $('#price_bank').val();
        $('#p_bank').val(v_bank);
        $('#bank').show();
    });
 </script>
  <section class="content">
    <div class="card card-success ">
      <div class="card-header">
        <h4 class="card-title"><b>คำนวณค่างวด...</b></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form name="form1" method="post" action="" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card-body text-sm">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-12">
                  <div class="form-group row mb-1">
                    <label class="col-sm-4 col-form-label text-right">ราคาจัดธนาคาร :</label>
                    <div class="col-sm-8">
                      <select id="price_bank" class="form-control form-control-sm">
                        <option value="">--เลือกธนาคาร--</option>
                        <option value="{{$datacar->Price_Thana}}">ราคาธนชาติ</option>
                        <option value="{{$datacar->Price_Scb}}">ราคาSCB</option>
                        <option value="{{$datacar->Price_Tisco}}">ราคาTisco</option>
                        <option value="{{$datacar->Price_AY}}">ราคาAY</option>
                        <option value="{{$datacar->Price_Kiatnakin}}">เกียรตินาคิน</option>
                        <option value="{{$datacar->Price_KLeasing}}">กสิกร</option>
                        <option value="{{$datacar->Price_Choo}}">ราคาชูเกียรติ</option>
                      </select>
                      <div style="display: none;" id="bank"><input type="text" id="p_bank" class="form-control" readonly></div>
                    </div>
                  </div>
                </div>
            </div>
             
              <div class="row">
                <div class="col-12">
                  <div class="form-group row mb-1">
                    <label class="col-sm-4 col-form-label text-right">ราคารถ :</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control form-control-sm" name="Price_car" id="Price_car" value="" />

                    </div>
                  </div>
                </div>
            </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-6 col-form-label text-right">เงินดาวน์ :</label>
                    <div class="col-sm-6">
                      <input type="text" id="down_payment1" name="down_payment1" class="form-control form-control-sm" placeholder="ป้อนราคาดาวน์" value=""  />
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group row mb-1">
                    <label class="col-sm-6 col-form-label text-right"> หรือ ดาวน์ %</label>
                    <div class="col-sm-6">
                      <input type="text" name="down_payment_percent1" id="down_payment_percent1" class="form-control form-control-sm" placeholder="ดาวน์ % " value=""/>
                    </div>
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group row mb-1">
                    <label class="col-sm-4 col-form-label text-right">ระยะเวลาผ่อนชำระ *</label>
                    <div class="col-sm-8">
                      <select name="installments_period1" id="installments_period1" class="form-control form-control-sm">                       
                        <option value="12" >12</option>
                        <option value="24" >24</option>
                        <option value="32" >32</option>
                        <option value="48" >48</option>
                        <option value="60" >60</option>
                        <option value="72" >72</option>
                        <option value="84" >84</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group row mb-1">
                    <label class="col-sm-4 col-form-label text-right">อัตราดอกเบี้ยต่อปี *</label>
                    <div class="col-sm-8">
                      <input type="text" name="interest_rate_percent1" id="interest_rate_percent1" class="form-control form-control-sm" placeholder="ดอกเบี้ยต่อปี" value=""  onkeyup ="calcu()" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="form-group row mb-1">
                    <label class="col-sm-4 col-form-label text-right">ยอดจัดเช่าซื้อ (รวม VAT)</label>
                    <div class="col-sm-8">
                      <input type="text" name="buy_loan1" id="buy_loan1" class="form-control form-control-sm" placeholder="ยอดจัด" value=""  readonly />
                    </div>
                  </div>
                  <div class="form-group row mb-1">
                    <label class="col-sm-4 col-form-label text-right">ค่างวดต่อเดือน (รวม VAT)</label>
                    <div class="col-sm-8">
                      <input type="text" name="loan_per_month1" id="loan_per_month1" class="form-control form-control-sm" placeholder="ค่างวดต่อเดือน" value=""  readonly />
                    </div>
                  </div>
                </div>
               <!-- <div class="box-footer">
                <div class="form-group" align="center">
                  <button type="submit" class="delete-modal btn btn-success">
                    <span class="glyphicon glyphicon-floppy-save"></span> บันทึก
                  </button>
                  <a class="delete-modal btn btn-danger" href="{{ URL::previous() }}">
                    <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                  </a>
                </div>
              </div> -->
            </div>
            
        

          <hr>
          
        </div>
      </div>
    </div>
    
    <input type="hidden" name="_method" value="PATCH"/>
  </form>
</div>
</section>
<script type="text/javascript">
  $('#other').click(function() {
    $("#otherS").toggle(this.checked);
  });


</script>
