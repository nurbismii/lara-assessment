<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Evaluator;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function fetchEmployee(Request $request)
    {
        $users = Employee::select('id', 'name', 'employee_id')->where('employee_id', 'like', '%' . $request->q . '%')->limit(25)->get();
        return response()->json($users, 200);
    }

    public function fecthUser(Request $request)
    {
        $users = User::select('id', 'name', 'email')->where('email', 'like', '%' . $request->q . '%')->limit(25)->get();
        return response()->json($users, 200);
    }

    public function fetchEvaluator(Request $request)
    {
        $users = $users = Evaluator::whereHas('employee', function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->q . '%');
        })->with(['employee' => function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }])->limit(25)->get();
        return response()->json($users, 200);
    }
}
