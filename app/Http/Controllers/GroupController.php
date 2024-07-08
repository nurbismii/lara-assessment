<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    //
    public function index()
    {
        $groups = Group::join('users', 'group.group_leader_id', '=', 'users.id')
            ->join('evaluator', 'group.evaluator_id', '=', 'evaluator.id')
            ->leftjoin('employee', 'evaluator.employee_id', '=', 'employee.employee_id')
            ->select('group.*', 'users.name as leader_name', 'employee.name as evaluator_name')
            ->get();

        return view('group.index', compact('groups'));
    }

    public function store(Request $request)
    {
        Group::create([
            'name' => $request->name,
            'group_leader_id' => $request->group_leader_id,
            'evaluator_id' => $request->evaluator_id,
        ]);

        return back()->with('success', 'Berhasil melakukan penambahan grup.');
    }

    public function destroy($id)
    {
        Group::where('id', $id)->delete();

        return back()->with('success', 'Berhasil menghapus grup');
    }
}
