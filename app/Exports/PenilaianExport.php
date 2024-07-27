<?php

namespace App\Exports;

use App\Models\EvaluationHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PenilaianExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $year, $month;

    public function __construct($year, $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    public function collection()
    {
        return EvaluationHistory::with('employee', 'evaluation')->whereYear('evaluation_date', $this->year)->whereMonth('evaluation_date', $this->month)->get();
    }

    public function map($eval): array
    {
        $grades = $eval->evaluation->pluck('grade')->toArray();
        $totalGrade = array_sum($grades);

        return [
            $eval->id,
            $eval->employee->employee_id,
            $eval->employee->name,
            $eval->employee->departement,
            $eval->employee->divisi,
            $eval->evaluation_date,
            $eval->evaluation->pluck('name')->implode(', '),
            implode(', ', $grades),
            $eval->created_at,
            $eval->updated_at,
            $totalGrade,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'NIK',
            'Name',
            'Departement',
            'Divisi',
            'Evaluation Date',
            'Content',
            'Grades',
            'Created At',
            'Updated At',
            'Total'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        foreach ($sheet->getRowIterator() as $row) {
            $rowIndex = $row->getRowIndex();
            $contentCell = $sheet->getCell("G$rowIndex")->getValue();
            $gradesCell = $sheet->getCell("H$rowIndex")->getValue();

            $maxLines = max(substr_count($contentCell, "\n"), substr_count($gradesCell, "\n")) + 1;

            if ($maxLines > 1) {
                $sheet->mergeCells("A{$rowIndex}:F{$rowIndex}");
                $sheet->mergeCells("I{$rowIndex}:K{$rowIndex}");
            }

            $sheet->getStyle("G{$rowIndex}:H{$rowIndex}")->getAlignment()->setWrapText(true);
        }

        $sheet->getStyle('A:K')->getAlignment()->applyFromArray([
            'horizontal' => 'center',
            'vertical' => 'center',
        ]);

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
