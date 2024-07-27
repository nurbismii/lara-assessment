<?php

namespace App\Http\Controllers;

use App\Exports\PenilaianExport;
use App\Models\EvaluationHistory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReportController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->filled('date')) {
            $date = $request->date;
        } else {
            $date = now();
        }

        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));

        return view('report.index', compact('year', 'month'));
    }

    public function downloadReportExcel($year, $month)
    {
        return Excel::download(new PenilaianExport($year, $month), 'EvaluationExport ' . ($month . '-' . $year) . '.xlsx');
    }

    public function downloadReportPdf($year, $month)
    {
        $evaluationHistories = EvaluationHistory::with('employee', 'evaluation')->whereYear('evaluation_date', $year)->whereMonth('evaluation_date', $month)->get();

        $data = [];

        foreach ($evaluationHistories as $eval) {
            $grades = $eval->evaluation->pluck('grade')->toArray();
            $totalGrade = array_sum($grades);
            $contents = $eval->evaluation->pluck('name')->toArray();

            $data[] = [
                'ID' => $eval->id,
                'NIK' => $eval->employee->employee_id,
                'Name' => $eval->employee->name,
                'Departement' => $eval->employee->departement,
                'Divisi' => $eval->employee->divisi,
                'EvaluationDate' => $eval->evaluation_date,
                'Content' => $contents,
                'Grades' => $grades,
                'CreatedAt' => $eval->created_at,
                'UpdatedAt' => $eval->updated_at,
                'Total' => $totalGrade,
            ];
        }

        $pdf = PDF::loadView('report.penilaian-export-pdf', compact('data'))->setPaper('A4', 'landscape');
        return $pdf->download('evaluation_report (' . $month . '-' . $year . ').pdf');
    }
}
