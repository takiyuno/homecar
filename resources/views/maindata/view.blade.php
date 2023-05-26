@extends('layouts.master')
@section('title','ข้อมูลหลัก')
@section('content')

  <!-- Main content -->
  <section class="content">
    <div class="content-header">
      @if(session()->has('success'))
        <script type="text/javascript">
          toastr.success('{{ session()->get('success') }}')
        </script>
      @endif

      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="" style="text-align:center;"><b>ข้อมูลสมาชิกผู้ใช้งาน</b></h3>
              </div>
              <div class="card-body">
                <div class="float-right form-inline"> 
                  <a href="{{ route('MasterMaindata.show',[1]) }}" class="btn btn-success">
                    <span class="glyphicon glyphicon-plus"></span> Register
                  </a>
                </div>
                <br><br>
                
                <table class="table table-bordered" id="table1">
                  <thead class="thead-dark">
                    <tr>
                      <th class="text-center">No.</th>
                      <th class="text-center">Name</th>
                      <th class="text-center">Username</th>
                      <th class="text-center">Password</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">ตำแหน่ง</th>
                      <th class="text-center" width="150px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $key => $row)
                      <tr>
                        <td class="text-center">{{ $key+1 }}</td>
                        <td class="text-center">{{ $row->name }}</td>
                        <td class="text-center">{{ $row->username }}</td>
                        <td class="text-center">{{ $row->password_token }}</td>
                        <td class="text-center">{{ $row->email }}</td>
                        <td class="text-center">{{ $row->position }}</td>
                        <td class="text-center">
                          <a href="{{ route('MasterMaindata.edit',[$row['id']]) }}" class="btn btn-warning btn-sm">
                            <span class="glyphicon glyphicon-edit"></span> Edit
                          </a>

                          <form method="post" class="delete_form" action="{{ route('MasterMaindata.destroy',$row['id']) }}" style="display:inline;">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE" />
                            <button type="submit" data-name="{{ $row->username }}" class="delete-modal btn btn-danger btn-sm AlertForm">
                              <span class="glyphicon glyphicon-trash"></span> Delete
                            </button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>

                <a id="button"></a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>

  {{-- button-to-top --}}
  <script>
    var btn = $('#button');

    $(window).scroll(function() {
      if ($(window).scrollTop() > 300) {
        btn.addClass('show');
      } else {
        btn.removeClass('show');
      }
    });

    btn.on('click', function(e) {
      e.preventDefault();
      $('html, body').animate({scrollTop:0}, '300');
    });
  </script>

  <script>
    $(function () {
      $("#table1").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ordering": true,
      });
    });
  </script>

  <script>
    $(".alert").fadeTo(3000, 500).slideUp(500, function(){
      $(".alert").alert('close');
    });;
  </script>

@endsection
