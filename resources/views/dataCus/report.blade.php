<section class="content">
     
        <div class="modal-body">
          <div class="card card-warning">
            <div class="card-header">
              <h4 class="card-title">รายงานติดตามลูกค้า</h4>
              <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
          </div>
      </div>
        <div class="modal-body text-sm">
          <form target="_blank" action="{{ action('ResearchCusController@ReportCus') }}" method="post">
            
            <input type="hidden" name="type" value="3">
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

            <div class="card-footer text-center">
              <button type="submit" class="btn bg-warning btn-app">
                <i class="fas fa-search"></i> print
              </button>
              <a class="btn btn-app bg-danger" href="{{ URL::previous() }}" >
                <i class="fas fa-times"></i> ยกเลิก
              </a>
            </div>
          </form>
        </div>

    </section>
   