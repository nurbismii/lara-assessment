<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvaluatorRequest;
use App\Models\Evaluator;
use Illuminate\Http\Request;

class EvaluatorController extends Controller
{
    //
    public function index()
    {
    }

    public function store(StoreEvaluatorRequest $request)
    {
        Evaluator::create([
            'employee_id' => $request->employee_id,
        ]);

        return back()->with('success', 'Penilai grup berhasil ditambahkan');
    }
}
