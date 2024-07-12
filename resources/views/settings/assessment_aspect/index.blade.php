@extends('layouts.app')
@section('contents')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Aspek Penilaian 评估内容</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('assessment-aspect.store') }}" method="post" enctype="application/x-www-form-urlencoded">
            @csrf
            <div class="form-group">
              <label for="labelNama">Nama</label>
              <input type="text" name="name" class="form-control">
              <small id="emailHelp" class="form-text text-muted">Tuliskan nama aspek penilaian.</small>
            </div>
            <div class="form-group">
              <label for="labelAtribut">Atribut</label>
              <select name="atribut" class="form-control" id="">
                <option value="">Pilih atribut :</option>
                <option value="1">Benefit</option>
                <option value="2">Cost</option>
                <option value="3">Lainnya</option>
              </select>
            </div>
            <div class="form-group">
              <label for="labelBobot">Bobot</label>
              <input type="number" name="bobot" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data Aspek Penilaian</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Atribut</th>
                  <th>Bobot</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($assessments as $row)
                <tr>
                  <td>{{$row->name}}</td>
                  <td>{{$row->atribut == '1' ? 'Benefit' : 'Cost'}}</td>
                  <td>{{$row->bobot}}</td>
                  <td>
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Opsi
                      </button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" data-toggle="modal" data-target="#assessmentEdit{{$row->id}}">Edit</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#assessmentDelete{{$row->id}}">Hapus</a>
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

<!-- Modal edit assessment -->
@foreach($assessments as $row)
<div class="modal fade" id="assessmentEdit{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelEditAspekPenilaian">Edit aspek penilaian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('assessment-aspect.update', $row->id) }}" method="post" enctype="application/x-www-form-urlencoded">
        <div class="modal-body">
          @csrf
          {{method_field('patch')}}
          <div class="form-group">
            <label for="labelNama">Nama</label>
            <input type="text" name="name" class="form-control" value="{{$row->name}}">
            <small id="emailHelp" class="form-text text-muted">Tuliskan nama aspek penilaian.</small>
          </div>
          <div class="form-group">
            <label for="labelAtribut">Atribut</label>
            <select name="atribut" class="form-control">
              <option value="{{$row->id}}" selected>{{$row->atribut == '1' ? 'Benefit' : 'Cost'}}</option>
              <option value="1">Benefit</option>
              <option value="2">Cost</option>
              <option value="3">Lainnya</option>
            </select>
          </div>
          <div class="form-group">
            <label for="labelBobot">Bobot</label>
            <input type="number" value="{{$row->bobot}}" name="bobot" class="form-control">
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

<!-- Modal destroy assessment -->
@foreach($assessments as $row)
<div class="modal fade" id="assessmentDelete{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelEditAspekPenilaian">Yakin ingin menghapus data ini ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('assessment-aspect.destroy', $row->id) }}" method="post" enctype="application/x-www-form-urlencoded">
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