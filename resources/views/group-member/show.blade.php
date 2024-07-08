@extends('layouts.app')
@section('contents')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah anggota kelompok</h1>
    <a href="{{ route('group-member.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-lg-12">
      @include('layouts.message')
    </div>
    <div class="col-lg-12">
      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">{{ $group->name }}</h1>
          <p class="lead">Halaman ini untuk menambahkan anggota kedalam grup {{ $group->name }}.</p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mb-3">
      <div class="card">
        <div class="card-body">
          <form action="{{route('group-member.store')}}" method="post" enctype="application/x-www-form-urlencoded">
            @csrf
            <div class="form-group">
              <label>Karyawan</label>
              <input type="hidden" name="group_id" class="form-control mb-2" value="{{$group->id}}">
              <select multiple name="employee_id[]" class="form-control" id="employee_id">
                @foreach($employees as $employee)
                <option value="{{$employee->id}}">{{$employee->employee_id}} - {{$employee->name}}</option>
                @endforeach
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Anggota Kelompok</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Hapus</th>
                </tr>
              </thead>
              <tbody>
                @foreach($group_members as $group_member)
                <tr>
                  <td>{{$group_member->employee->employee_id}}</td>
                  <td>{{$group_member->employee->name}}</td>
                  <td>
                    <a data-toggle="modal" data-target="#groupMemberDelete{{$group_member->id}}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-trash fa-sm text-white-50"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('select-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('#employee_id').select2({
      width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
      theme: "bootstrap-5",
      allowClear: true,
      placeholder: 'Pilih karyawan...',
    });

    // Definisikan variabel selectedValues di luar blok event
    var selectedValuesEmpID = [];

    // Event select2:select
    $('#employee_id').on('select2:select', function(e) {
      var selectedValue = e.params.data.id;
      selectedValuesEmpID.push(selectedValue);
    });

    // Event select2:unselect
    $('#employee_id').on('select2:unselect', function(e) {
      var unselectedValue = e.params.data.id;
      var index = selectedValues.indexOf(unselectedValue);
      if (index !== -1) {
        selectedValuesEmpID.splice(index, 1);
      }
    });
  });
</script>
@endpush

@endsection