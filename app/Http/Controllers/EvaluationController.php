<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Employee;
use App\Models\Evaluation;
use App\Models\Evaluator;
use App\Models\GroupMembers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    //
    public function index()
    {
        $group_members_query = Evaluator::join('group', 'evaluator.id', '=', 'group.evaluator_id')
            ->join('group_member', 'group_member.group_id', '=', 'group.id')
            ->join('employee', 'employee.id', '=', 'group_member.employee_id')
            ->join('employee as evaluator_employee', 'evaluator_employee.employee_id', '=', 'evaluator.employee_id')
            ->select(
                'group_member.*',
                'evaluator.employee_id as evaluator_nik',
                'group.name as group_name',
                'group.group_leader_id as leader_id',
                'group.evaluator_id',
                'employee.name as employee_name',
                'employee.employee_id as employee_id',
                'employee.id as emp_id',
                'evaluator_employee.name as evaluator_name'
            );

        if (Auth::user()->level_access == 3) {
            $group_members_query->where('evaluator.employee_id', Auth::user()->employee_id);
        }

        $group_members = $group_members_query->get();

        return view('evaluation.index', compact('group_members'));
    }

    public function show($id)
    {
        $member = GroupMembers::with('employee')->where('id', $id)->first();

        $assessments = Assessment::with('performAchievement')->select('*')->get();

        return view('evaluation.show', compact('member', 'assessments'));
    }

    public function store(Request $request)
    {
        foreach ($request->assessment as $assessment_id => $perform_id) {
            Evaluation::create([
                'perform_achieve_id' => $perform_id,
                'group_id' => $request->group_id,
                'employee_id' => $request->employee_id,
                'assessment_date' => $request->assessment_date
            ]);
        }

        return redirect('evaluation')->with('success', 'Berhasil melakukan penilaian, silahkan periksa pada halaman Hasil Penilaian');
    }

    public function detail(Request $request, $id)
    {
        $year = date('Y', strtotime($request->assessment_date));
        $month = date('m', strtotime($request->assessment_date));

        $employee = Employee::where('id', $id)->first();

        $assessments = Assessment::with('performAchievement')
            ->join('perform_achievement', 'perform_achievement.aspect_id', '=', 'assessment_aspect.id')
            ->join('evaluation', 'evaluation.perform_achieve_id', '=', 'perform_achievement.id')
            ->select('assessment_aspect.*', 'evaluation.employee_id as evaluation_employee_id', 'evaluation.perform_achieve_id', 'evaluation.assessment_date')
            ->whereYear('evaluation.assessment_date', '=', $year)
            ->whereMonth('evaluation.assessment_date', '=', $month)
            ->where('evaluation.employee_id', $id)
            ->get();

        return view('evaluation.detail', compact('employee', 'assessments', 'year', 'month'));
    }

    public function destroyEvaluation(Request $request, $id)
    {
        Evaluation::where('employee_id', $id)
            ->whereMonth('assessment_date', $request->month)
            ->whereYear('assessment_date', $request->year)
            ->delete();

        return back()->with('success', 'Berhasil menghapus penilaian');
    }
}
