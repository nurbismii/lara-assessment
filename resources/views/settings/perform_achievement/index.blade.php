@extends('layouts.app')
@section('contents')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pencapaian Kinerja 绩效成</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-lg-4">
      <div class="card">
        <form action="{{ route('perform-achievement.store') }}" method="post" enctype="application/x-www-form-urlencoded">
          <div class="card-body">
            @csrf
            <div class="form-group">
              <label for="labelAssessment">Aspek Penilaian</label>
              <select name="aspect_id" class="form-control" required>
                <option value="" disabled selected>Pilih aspek penilain :</option>
                @foreach($assessments as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="labelPencapaianKerja">Pencapain kerja</label>
              <input type="text" class="form-control" name="name">
              <small id="emailHelp" class="form-text text-muted">Tuliskan nama pencapaian kerja.</small>
            </div>
            <div class="form-group">
              <label for="labelNilai">Nilai</label>
              <input type="text" name="grade" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
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
                  <th>Pencapaian</th>
                  <th>Aspek</th>
                  <th>Nilai</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($perform_achievements as $row)
                <tr>
                  <td>{{$row->name}}</td>
                  <td>{{$row->assessment->name ?? ''}}</td>
                  <td>{{$row->grade}}</td>
                  <td>
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Opsi
                      </button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" data-toggle="modal" data-target="#performAchievementEdit{{$row->id}}">Edit</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#performAchievementDelete{{$row->id}}">Hapus</a>
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

<!-- Modal edit performance achievement -->
@foreach($perform_achievements as $row)
<div class="modal fade" id="performAchievementEdit{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelEditAspekPenilaian">Edit pencapaian kerja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('perform-achievement.update', $row->id) }}" method="post" enctype="application/x-www-form-urlencoded">
        <div class="modal-body">
          @csrf
          {{method_field('patch')}}
          <div class="form-group">
            <label for="labelAspect">Aspek Penilaian</label>
            <select name="aspect_id" class="form-control">
              <option value="{{ $row->assessment->id ?? ''}}" selected>{{$row->assessment->name ?? ''}}</option>
              @foreach($assessments as $data)
              <option value="{{$data->id}}">{{$data->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="labelPencapaianKerja">Pencapain kerja</label>
            <input type="text" name="name" class="form-control" value="{{$row->name}}">
            <small class="form-text text-muted">Tuliskan nama pencapaian kerja.</small>
          </div>
          <div class="form-group">
            <label for="labelNilai">Nilai</label>
            <input type="text" name="grade" class="form-control" value="{{$row->grade}}">
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

<!-- Modal destroy performance achievemenet -->
@foreach($perform_achievements as $row)
<div class="modal fade" id="performAchievementDelete{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelEditAspekPenilaian">Yakin ingin menghapus data ini ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('perform-achievement.destroy', $row->id) }}" method="post" enctype="application/x-www-form-urlencoded">
        @csrf
        {{method_field('delete')}}
        <div class="modal-body">
          <i class="text-bold">{{ $row->name }}</i>
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