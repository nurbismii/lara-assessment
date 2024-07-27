@extends('layouts.app')
@section('contents')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan 评估</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            @include('layouts.message')
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Download Laporan 下载报告</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('report.index') }}" method="get">
                        <div class="input-group mb-3">
                            <input type="month" name="date" class="form-control" value="{{ $year . '-' . $month}}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                                <a class="btn btn-outline-secondary" href="{{ route('report.index') }}">Hapus</a>
                            </div>
                        </div>
                    </form>
                    <a href="{{ route('download.excel', ['year' => $year, 'month' => $month]) }}" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-file-excel"></i>
                        </span>
                        <span class="text">Download hasil penilaian (excel)</span>
                    </a>
                    <div class="my-2"></div>
                    <a href="{{ route('download.pdf', ['year' => $year, 'month' => $month]) }}" class="btn btn-danger btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-file-pdf"></i>
                        </span>
                        <span class="text">Download hasil penilaian (PDF)</span>
                    </a>
                    <div class="my-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection