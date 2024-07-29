@extends('layouts.app')
@section('contents')
<style>
    .center {
        margin: auto;
        width: 50%;
        border: 3px solid green;
        padding: 10px;
    }
</style>

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
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Periode Laporan 报告期</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('report.index') }}" method="get">
                        <div class="input-group mb-3">
                            <input type="month" name="date" class="form-control" value="{{ $year . '-' . $month}}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Cari 寻找</button>
                                <a class="btn btn-outline-secondary" href="{{ route('report.index') }}">Hapus 删除</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="float-right">
                        <a href="{{ route('download.excel', ['year' => $year, 'month' => $month]) }}" class="btn btn-success btn-icon-split mb-3">
                            <span class="icon text-white-50">
                                <i class="fas fa-file-excel"></i>
                            </span>
                            <span class="text">Excel 卓越</span>
                        </a>
                        <a href="{{ route('download.pdf', ['year' => $year, 'month' => $month]) }}" class="btn btn-danger btn-icon-split mb-3">
                            <span class="icon text-white-50">
                                <i class="fas fa-file-pdf"></i>
                            </span>
                            <span class="text">PDF</span>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NIK</th>
                                    <th>Name</th>
                                    <th>Departement</th>
                                    <th>Divisi</th>
                                    <th>Evaluation Date</th>
                                    <th>Total Poin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $row)
                                <tr>
                                    <td class="align-middle">{{ $row['NIK'] }}</td>
                                    <td class="align-middle">{{ $row['Name'] }}</td>
                                    <td class="align-middle">{{ $row['Departement'] }}</td>
                                    <td class="align-middle">{{ $row['Divisi'] }}</td>
                                    <td class="align-middle">{{ $row['EvaluationDate'] }}</td>
                                    <td class="align-middle">{{ $row['Total'] }}</td>
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