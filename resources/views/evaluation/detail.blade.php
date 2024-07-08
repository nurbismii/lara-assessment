@extends('layouts.app')
@section('contents')
@push('css')
<style>
  .profile-card {
    padding: 20px;
  }

  .profile-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .profile-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
  }

  .profile-info {
    flex-grow: 1;
    margin-left: 20px;
  }

  .profile-info th,
  .profile-info td {
    text-align: left;
    padding: 2px 0;
  }

  .profile-info th {
    width: 120px;
  }

  .highlight {
    background-color: #4e73df;
    color: white;
  }
</style>
@endpush

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Hasil penilaian</h1>
    <a href="{{route('evaluation.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali</a>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-lg-12">
      @include('layouts.message')
    </div>
    <div class="col-lg-8">
      <div class="card shadow mb-4 profile-card">
        <div class="card-header py-3 profile-header">
          <div class="profile-info">
            <table class="table table-borderless">
              <tr>
                <th>Nama</th>
                <td>:</td>
                <td>{{ $employee->name }}</td>
              </tr>
              <tr>
                <th>NIK</th>
                <td>:</td>
                <td>{{ $employee->employee_id }}</td>
              </tr>
              <tr>
                <th>Departemen</th>
                <td>:</td>
                <td>{{ $employee->departement }}</td>
              </tr>
              <tr>
                <th>Divisi</th>
                <td>:</td>
                <td>{{ $employee->divisi }}</td>
              </tr>
            </table>
          </div>
          <!-- Ganti URL dengan URL gambar profil Anda -->
          <img src="https://via.placeholder.com/100" alt="Profile Image" class="profile-img">
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow mb-4">
        <div class="card-body py-3">
          <form action="" method="get">
            <div class="form-row align-items-center">
              <div class="col-md-12 mb-3">
                <label>Pilih periode</label>
                <input class="form-control" name="assessment_date" type="month">
              </div>
              <div class="col-auto">
                <a href="{{ route('evaluation.detail', $employee->id) }}" class="btn btn-danger">Bersihkan..</a>
                <button type="submit" class="btn btn-primary">Cari penilaian..</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="text-center bg-dark text-white">
        {{ $year < 2014 ? '-' : $month}} - {{ $year < 2014 ? '-' : $year }}
      </div>
    </div>
    @if($year >= '2015' && count($assessments))
    <div class="col-lg-12">
      <div class="card shadow border-primary mb-4">
        <div class="card-body py-3">
          <blockquote class="blockquote text-center">
            <p class="mb-0">HASIL PENILAIAN {{$employee->name}}.</p>
            <footer>{{ $year < 2014 ? '-' : $month}} - {{ $year < 2014 ? '-' : $year }}</footer>
            <div class="text-right">
              <a data-toggle="modal" data-target="#evaluationDelete{{$employee->id}}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-trash fa-sm text-white-50"></i></a>
            </div>
          </blockquote>

          <table class="table table-bordered">
            @foreach($assessments as $assessment)
            <tr>
              <th rowspan="{{ count($assessment->performAchievement) + 1 }}">{{ $assessment->name }}</th>
            </tr>
            @foreach($assessment->performAchievement as $perform_achieve)
            <tr>
              <td @if($assessment->perform_achieve_id == $perform_achieve->id) class="highlight" @endif>
                {{ $perform_achieve->name }}
              </td>
              @if($assessment->perform_achieve_id == $perform_achieve->id)
              <td>&radic;</td>
              @endif
            </tr>
            @endforeach
            @endforeach
          </table>
        </div>
      </div>
    </div>
    @elseif($year < '2015' ) <div class="col-lg-12">
      <div class="card shadow border-primary mb-4">
        <div class="card-body py-3 text-center">
          Silahkan pilih periode terlebih
        </div>
      </div>
  </div>
  @else
  <div class="col-lg-12">
    <div class="card shadow border-danger mb-4">
      <div class="card-body py-3 text-center">
        Periode yang kamu inginkan belum tersedia...
      </div>
    </div>
  </div>
  @endif
</div>
</div>

<!-- Modal destroy evaluation -->
<div class="modal fade" id="evaluationDelete{{$employee->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelEditAspekPenilaian">Yakin ingin menghapus penilaian ini ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('evaluation.evalDestroy', $employee->id)}}" method="post" enctype="application/x-www-form-urlencoded">
        <div class="modal-body">
          @csrf
          <input type="hidden" class="form-control" name="month" value="{{$month}}">
          <input type="hidden" class="form-control" name="year" value="{{$year}}">
          Periode {{$month}} {{$year}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection