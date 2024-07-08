@extends('layouts.app')
@section('contents')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Penilaian</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-lg-12">
      @include('layouts.message')
    </div>
    <div class="col-lg-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data Anggota</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Penilai</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($group_members as $member)
                <tr>
                  <td>{{$member->employee_id}}</td>
                  <td>{{$member->employee_name}}</td>
                  <td>{{$member->evaluator_name}}</td>
                  <td>
                    <a href="{{ route('evaluation.show', $member->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Penilaian</a>
                    <a href="{{ route('evaluation.detail', $member->emp_id) }}" type="button" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">Detail</a>
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

@endsection