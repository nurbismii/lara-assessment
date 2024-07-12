@extends('layouts.app')
@section('contents')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Karyawan 员工</h1>
    <a href="{{ route('employee.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
      <i class="fas fa-plus fa-sm text-white-50"></i> Buat baru 创建一个新的
    </a>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-lg-12">
      @include('layouts.message')
    </div>
    <div class="col-lg-6 mb-3">
      <div class="card border-primary">
        <div class="card-body">
          <form action="{{route('store.excel.employee')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="labelBulkUpload">Bulk buat baru 批量创建一个新的</label>
            <div class="input-group mb-3">
              <div class="custom-file">
                <input type="file" name="file" class="form-control">
              </div>
            </div>
            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Kirim 发送</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mb-3">
      <div class="card border-danger">
        <div class="card-body">
          <form action="{{route('update.excel.employee')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="labelBulkHapus">Bulk pembaruan 员工批次更新</label>
            <div class="input-group mb-3">
              <div class="custom-file">
                <input type="file" name="file" class="form-control">
              </div>
            </div>
            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary">Kirim 发送</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-12 mb-3">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data Karyawan 员工数据</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>NIK 新工号</th>
                  <th>Nama 员工姓名</th>
                  <th>Departemen 大部门</th>
                  <th>Divisi 部门</th>
                  <th>Aksi 行动</th>
                </tr>
              </thead>
              <tbody>
                @foreach($employees as $employee)
                <tr>
                  <td>{{$employee->employee_id}}</td>
                  <td>{{$employee->name}}</td>
                  <td>{{$employee->departement}}</td>
                  <td>{{$employee->divisi}}</td>
                  <td>
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Opsi 选择权
                      </button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="{{route('employee.edit', $employee->id)}}">Edit 改变</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#employeeDelete{{$employee->id}}">Hapus 删除</a>
                      </div>
                    </div>
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

<!-- Modal destroy assessment -->
@foreach($employees as $row)
<div class="modal fade" id="employeeDelete{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelEditAspekPenilaian">Yakin ingin menghapus karyawan ini ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('employee.destroy', $employee->id)}}" method="post" enctype="application/x-www-form-urlencoded">
        <div class="modal-body">
          @csrf
          {{method_field('delete')}}
          {{$row->name}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

@endsection