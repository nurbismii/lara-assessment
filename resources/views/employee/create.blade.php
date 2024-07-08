@extends('layouts.app')
@section('contents')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Karyawan</h1>
    <a href="{{ route('employee.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-lg-12">
      @include('layouts.message')
    </div>
    <div class="col-lg-12 mb-3">
      <div class="card">
        <div class="card-body">
          <form action="{{route('employee.store')}}" method="post" enctype="application/x-www-form-urlencoded">
            @csrf
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="labelNik">NIK</label>
                <input type="text" class="form-control" name="employee_id">
              </div>
              <div class="form-group col-md-6">
                <label for="labelNama">Nama</label>
                <input type="text" name="name" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress">Departemen</label>
              <input type="text" class="form-control" name="departement">
            </div>
            <div class="form-group">
              <label for="inputAddress2">Divisi</label>
              <input type="text" class="form-control" name="divisi">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection