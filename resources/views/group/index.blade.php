@extends('layouts.app')
@section('contents')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Grup 群</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-lg-12">
      @include('layouts.message')
    </div>
    <div class="col-lg-4">
      <div class="card mb-3">
        <div class="card-body">
          <form action="{{ route('evaluator.store') }}" method="post" enctype="application/x-www-form-urlencoded">
            @csrf
            <div class="form-group">
              <label>Tambah Penilai Group</label>
              <select name="employee_id" class="form-control" id="employee_id"></select>
              @if($errors->has('employee_id'))
              <div class="alert alert-danger mt-2">{{ $errors->first('employee_id') }}</div>
              @endif
            </div>
            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Simpan</button>
          </form>
        </div>
      </div>
      <div class="card mb-3">
        <div class="card-body">
          <form action="{{ route('group.store') }}" method="post" enctype="application/x-www-form-urlencoded">
            @csrf
            <div class="form-group">
              <label>Nama grup</label>
              <input type="text" name="name" class="form-control">
              <small class="form-text text-muted">Tuliskan nama grup/divisi.</small>
            </div>
            <div class="form-group">
              <label>Ketua grup</label>
              <select name="group_leader_id" class="form-control" id="group_leader_id"> </select>
            </div>
            <div class="form-group">
              <label>Penilai grup</label>
              <select name="evaluator_id" class="form-control" id="evaluator_id"> </select>
            </div>
            <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Simpan</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data Grup</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Ketua</th>
                  <th>Penilai</th>
                  <th>Nama</th>
                  <th>Hapus</th>
                </tr>
              </thead>
              <tbody>
                @foreach($groups as $group)
                <tr>
                  <td>{{strtoupper($group->leader_name)}}</td>
                  <td>{{strtoupper($group->evaluator_name)}}</td>
                  <td>{{strtoupper($group->name)}}</td>
                  <td>
                    <a class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal" data-target="#groupDelete{{$group->id}}"><i class="fas fa-trash fa-sm text-white-50"></i></a>
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

<!-- Modal destroy group -->
@foreach($groups as $group)
<div class="modal fade" id="groupDelete{{$group->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelEditAspekPenilaian">Yakin ingin menghapus grup ini ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('group.destroy', $group->id)}}" method="post" enctype="application/x-www-form-urlencoded">
        <div class="modal-body">
          @csrf
          {{method_field('delete')}}
          {{$group->name}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

@push('select-script')
<!-- Select 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
  $('#employee_id').select2({
    width: 'resolve',
    theme: 'classic',
    placeholder: 'Pilih penilai grup...',
    ajax: {
      url: '/api/employees',
      dataType: 'json',
      delay: 250,
      processResults: function(data) {
        return {
          results: $.map(data, function(item) {
            return {
              text: item.employee_id + ' - ' + item.name,
              id: item.employee_id
            }
          })
        };
      },
      cache: true
    }
  });

  $('#group_leader_id').select2({
    width: 'resolve',
    theme: 'classic',
    placeholder: 'Pilih ketua grup...',
    ajax: {
      url: '/api/users',
      dataType: 'json',
      delay: 250,
      processResults: function(data) {
        return {
          results: $.map(data, function(item) {
            return {
              text: item.email,
              id: item.id
            }
          })
        };
      },
      cache: true
    }
  });

  $('#evaluator_id').select2({
    width: 'resolve',
    theme: 'classic',
    placeholder: 'Pilih ketua grup...',
    ajax: {
      url: '/api/evaluators',
      dataType: 'json',
      delay: 250,
      processResults: function(data) {
        return {
          results: $.map(data, function(item) {
            return {
              text: item.employee_id + ' - ' + item.employee.name,
              id: item.id
            }
          })
        };
      },
      cache: true
    }
  });
</script>
@endpush

@endsection