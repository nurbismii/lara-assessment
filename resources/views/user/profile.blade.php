@extends('layouts.app')
@section('contents')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profile</h1>
    <!-- <a data-toggle="modal" data-target="#userCreate" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Buat</a> -->
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-lg-12">
      @include('layouts.message')
    </div>
    <div class="col-lg-4 mb-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-column align-items-center text-center">
            <img src="{{asset('img/undraw_profile.svg')}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
            <div class="mt-3">
              <h4>{{ $user->name }}</h4>
              <p class="text-secondary mb-1">{{ $user->email }}</p>
              <p class="text-muted font-size-sm">{{ $user->employee_id }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8 mb-3">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('user.update', $user->id) }}" method="post">
            @csrf
            {{ method_field('patch') }}
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Nama</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Email</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input type="text" name="email" class="form-control" value="{{ $user->email }}">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Kata sandi</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input type="password" name="password" class="form-control">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Konfirmasi kata sandi</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                <input type="password" name="confirm_password" class="form-control">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3"></div>
              <div class="col-sm-9 text-secondary">
                <input type="submit" class="btn btn-primary px-4" value="Simpan perubahan">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection