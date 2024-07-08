@extends('layouts.app')
@section('contents')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pengguna</h1>
    <a data-toggle="modal" data-target="#userCreate" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Buat</a>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-lg-12">
      @include('layouts.message')
      <div class="card shadow mb-3">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data Pengguna</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Level</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->level_access}}</td>
                  <td>{{$user->user_status == '' ? 'Aktif' : 'Tidak Aktif'}}</td>
                  <td>
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Opsi
                      </button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" data-toggle="modal" data-target="#userEdit{{$user->id}}">Edit</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#userDelete{{$user->id}}">Nonaktif</a>
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

<!-- User modal create -->
<div class="modal fade" id="userCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelEditAspekPenilaian">Edit pencapaian kerja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('user.store')}}" method="post" enctype="application/x-www-form-urlencoded">
        <div class="modal-body">
          @csrf
          <div class="form-group">
            <label>NIK</label>
            <input type="text" class="form-control" name="employee_id">
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="name">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email">
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Kata Sandi</label>
              <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group col-md-6">
              <label>Konfirmasi Kata Sandi</label>
              <input type="password" class="form-control" name="confirm_password">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- User modal edit -->
@foreach($users as $user)
<div class="modal fade" id="userEdit{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelEditAspekPenilaian">Edit pencapaian kerja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('user.update', $user->id)}}" method="post" enctype="application/x-www-form-urlencoded">
        <div class="modal-body">
          @csrf
          {{method_field('patch')}}
          <div class="form-group">
            <label>NIK</label>
            <input type="text" class="form-control" name="employee_id" value="{{$user->employee_id}}">
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="name" value="{{$user->name}}">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="{{$user->email}}">
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Kata Sandi</label>
              <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group col-md-6">
              <label>Konfirmasi Kata Sandi</label>
              <input type="password" class="form-control" name="confirm_password">
            </div>
          </div>
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

<!-- User modal disable -->
@foreach($users as $user)
<div class="modal fade" id="userDelete{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelEditAspekPenilaian">Yakin ingin nonaktifkan pengguna ini ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('user.disable', $user->id)}}" method="post" enctype="application/x-www-form-urlencoded">
        <div class="modal-body">
          @csrf
          {{$user->name}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Non aktifkan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

@endsection