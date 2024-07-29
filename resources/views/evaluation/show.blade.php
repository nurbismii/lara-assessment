@extends('layouts.app')
@section('contents')

@push('css')
<style>
  .custom-radio .custom-control-label::before {
    border-radius: 50%;
  }

  .custom-radio .custom-control-label::after {
    border-radius: 50%;
  }

  .custom-control-input:checked~.custom-control-label::before {
    color: #fff;
    border-color: #007bff;
    background-color: #007bff;
  }

  .custom-control-input:checked~.custom-control-label::after {
    background-color: #007bff;
  }

  .custom-control-input:focus~.custom-control-label::before {
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
  }

  .category-title {
    font-weight: bold;
    margin-top: 3px;
  }

  .radio-group {
    padding: 15px;
    border: 1px solid #e9ecef;
    border-radius: .25rem;
    margin-bottom: 15px;
  }

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
</style>
@endpush

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Penilaian 评估</h1>
    <a href="{{route('evaluation.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali 返回</a>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-lg-12">
      @include('layouts.message')
    </div>
    <div class="col-lg-12">
      <div class="card shadow mb-4 profile-card">
        <div class="card-header py-3 profile-header">
          <div class="profile-info">
            <table class="table table-borderless">
              <tr>
                <th>Nama 员工姓名</th>
                <td>:</td>
                <td>{{ $member->employee->name }}</td>
              </tr>
              <tr>
                <th>NIK 新工号</th>
                <td>:</td>
                <td>{{ $member->employee->employee_id }}</td>
              </tr>
              <tr>
                <th>Departemen 大部门</th>
                <td>:</td>
                <td>{{ $member->employee->departement }}</td>
              </tr>
              <tr>
                <th>Divisi 部门</th>
                <td>:</td>
                <td>{{ $member->employee->divisi }}</td>
              </tr>
            </table>
          </div>
          <!-- Ganti URL dengan URL gambar profil Anda -->
          <img src="https://via.placeholder.com/100" alt="Profile Image" class="profile-img">
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Poin Penilaian 评估值</h6>
        </div>
        <div class="card-body">
          <form action="{{route('evaluation.store')}}" method="post" id="evaluationForm">
            @csrf
            <input class="form-control form-control-sm" name="group_id" type="hidden" value="{{$member->group_id}}">
            <input class="form-control form-control-sm" name="employee_id" type="hidden" value="{{$member->employee_id}}">
            <input class="form-control form-control-sm" name="assessment_date" type="hidden" value="{{date('Y-m-d', strtotime(now()))}}">
            @php
            $no = 1;
            @endphp
            @foreach($assessments as $assessment)
            <div class="radio-group">
              <div class="category-title mb-2">{{$no++}}. {{ $assessment->name }} ...</div>
              @foreach($assessment->performAchievement as $perform)
              <?php $radioId = 'assessment_' . $assessment->id . '_' . $perform->id; ?>
              <div class="custom-control custom-radio mb-2">
                <input type="radio" id="{{ $radioId }}" name="assessment[{{ $assessment->id }}]" value="{{ $perform->id }}" class="custom-control-input" required>
                <label class="custom-control-label" for="{{ $radioId }}">{{ $perform->name }}</label>
              </div>
              @endforeach
            </div>
            @endforeach
            <button type="submit" class="btn btn-primary btn-lg btn-block" id="submitButton">Simpan 保持</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@push('disable-button')
<script>
  $(document).ready(function() {
    $('#evaluationForm').on('submit', function(event) {
      var submitButton = $('#submitButton');
      submitButton.prop('disabled', true);
      submitButton.text('Mengirim 发送 ...');
    });
  });
</script>
@endpush

@endsection