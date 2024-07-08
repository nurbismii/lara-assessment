<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeUpdateImport implements ToCollection, SkipsOnFailure, WithHeadingRow
{
    use Importable, SkipsFailures;

    private $employees, $AKTIF;

    public function __construct()
    {
        $this->AKTIF = 1;
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $collect) {
            $check_exist = Employee::where('employee_id', $collect['employee_id'])->first();
            if ($check_exist) {
                $check_exist->update([
                    'employee_status' => $this->AKTIF,
                ]);
            }
        }
    }
}
