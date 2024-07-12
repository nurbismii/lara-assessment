<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EvaluationHistory;
use App\Models\Evaluator;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

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

    public function alerts()
    {
        $evaluation_history = EvaluationHistory::with('employee')
            ->join('group_member', 'group_member.employee_id', '=', 'evaluation_history.employee_id')
            ->join('group', 'group.id', '=', 'group_member.group_id')
            ->orderBy('evaluation_history.id', 'ASC')
            ->limit(5);

        if (Auth::user()->level_access == 3) {
            $evaluation_history->where('group.evaluator_id', Auth::user()->id);
        }

        return $evaluation_history->get();
    }
}
