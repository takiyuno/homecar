@extends('layouts.master')
@section('title','ข้อมูลหลัก')
@section('content')

<!-- Main content -->
<section class="content">
  <div class="content-header">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>กรุณากรอกข้อมูลให้ครบช่อง {{$error}}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="" style="text-align:center;"><b>ข้อมูลสมาชิกผู้ใช้งาน</b></h3>
            </div>
            <div class="card-body">

              <div class="row">
                <div class="col-md-12"> <br />
                  <form method="post" action="{{ route('MasterMaindata.update',$id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')


                    <div class="row">
                      <div class="col-8">
                        <div class="float-right form-inline">
                          <label>Username : </label>
                          <input type="text" name="main_username" class="form-control" style="width: 400px;" placeholder="ป้อนชื่อผู้ใช้" value="{{$user->username}}" readonly />
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-8">
                        <div class="float-right form-inline">
                          <label>Password : </label>
                          <input id="password" type="password" style="width: 400px;" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  value="{{$user->password_token}}"  required >
                          @if ($errors->has('password'))
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                      <br>
                      <div class="row">
                        <div class="col-8">
                          <div class="float-right form-inline">
                            <label>Name : </label>
                            <input type="text" name="main_name" class="form-control" style="width: 400px;" placeholder="ป้อนชื่อ" value="{{$user->name}}" required/>
                          </div>
                        </div>
                      </div>

                      <br>
                      <div class="row">
                        <div class="col-8">
                          <div class="float-right form-inline">
                            <label>Enail : </label>
                            <input type="text" name="main_email" class="form-control" style="width: 400px;" placeholder="ป้อนอีเมลล์" value="{{$user->email}}" />
                          </div>
                        </div>
                      </div>
                      @if(auth::user()->position != "Admin" )
                      <input type="hidden" name="position" value="{{$user->position}}">
                      @endif
                     <!--  <br>
                      <div class="row">
                        <div class="col-8">
                          <div class="float-right form-inline">
                            <label>สาขา : </label>
                            <select name="branch" class="form-control" style="width: 400px;" required>
                              <option value="" selected>--------- สาขา ----------</option>
                              <option value="99" {{ ($user->branch === '99') ? 'selected' : '' }}>Admin</option>
                              <option value="10" {{ ($user->branch === '10') ? 'selected' : '' }}>สาขา รถบ้าน</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <br>
                      <div class="row">
                        <div class="col-8">
                          <div class="float-right form-inline">
                            <label>แผนก : </label>
                            <select name="section_type" class="form-control" style="width: 400px;" required>
                              <option value="" selected>--------- แผนก ----------</option>
                              <option value="Admin" {{ ($user->type === 'Admin') ? 'selected' : '' }}>Admin</option>
                              <option value="แผนก การขาย" {{ ($user->type === 'แผนก การขาย') ? 'selected' : '' }}>แผนก การขาย</option>
                              <option value="แผนก ช่างซ่อม" {{ ($user->type === 'แผนก ช่างซ่อม') ? 'selected' : '' }}>แผนก ช่างซ่อม</option>
                              <option value="แผนก ธุรการ" {{ ($user->type === 'แผนก ธุรการ') ? 'selected' : '' }}>แผนก ธุรการ</option>
                              <option value="แผนก ผู้จัดการ" {{ ($user->type === 'แผนก ผู้จัดการ') ? 'selected' : '' }}>แผนก ผู้จัดการ</option>
                            </select>
                          </div>
                        </div>
                      </div> -->
                      @if(auth::user()->position == "Admin" )
                      <br>
                      <div class="row">
                        <div class="col-8">
                          <div class="float-right form-inline">
                            <label>ตำแหน่ง : </label>
                            <select name="position" class="form-control" style="width: 400px;" required>
                              <option value="" selected>--------- ตำแหน่ง ----------</option>
                              <option value="Admin" {{ ($user->position === 'Admin') ? 'selected' : '' }}>Admin</option>
                              <option value="MANAGER" {{ ($user->position === 'MANAGER') ? 'selected' : '' }}>Sale MANAGER</option>
                              <option value="SALE" {{ ($user->position === 'SALE') ? 'selected' : '' }}>SALE</option>
                              <option value="Tradein" {{ ($user->position === 'Tradein') ? 'selected' : '' }}>Tradein Stafff</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      @endif
                      <br>
                      <div class="form-group" align="center">
                        <button type="submit" class="delete-modal btn btn-success">
                          <span class="glyphicon glyphicon-floppy-save"></span> อัพเดท
                        </button>
                        <a class="delete-modal btn btn-danger" href="{{ URL::previous() }}">ยกเลิก</a>
                      </div>
                      <input type="hidden" name="_method" value="PATCH"/>
                    </form>

                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>

  <script>
    $(".alert").fadeTo(3000, 500).slideUp(500, function(){
      $(".alert").alert('close');
    });;
  </script>

  @endsection
