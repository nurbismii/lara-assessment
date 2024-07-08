<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Group;
use App\Models\GroupMembers;
use Illuminate\Http\Request;

class GroupMembersController extends Controller
{
    //
    public function index()
    {
        $groups = Group::join('users', 'group.group_leader_id', '=', 'users.id')
            ->join('evaluator', 'group.evaluator_id', '=', 'evaluator.id')
            ->leftjoin('employee', 'evaluator.employee_id', '=', 'employee.employee_id')
            ->select('group.*', 'users.name as leader_name', 'employee.name as evaluator_name')
            ->get();

        return view('group-member.index', compact('groups'));
    }

    public function show($id)
    {
        $group = Group::join('users', 'group.group_leader_id', '=', 'users.id')
            ->join('evaluator', 'group.evaluator_id', '=', 'evaluator.id')
            ->leftjoin('employee', 'evaluator.employee_id', '=', 'employee.employee_id')
            ->select('group.*', 'users.name as leader_name', 'employee.name as evaluator_name')
            ->where('group.id', $id)
            ->first();

        $employees = Employee::select('id', 'employee_id', 'name')->get();

        $group_members = GroupMembers::with('employee')->where('group_id', $id)->select('*')->get();

        return view('group-member.show', compact('group', 'employees', 'group_members'));
    }

    public function store(Request $request)
    {
        $group_members = $request['employee_id'];

        for ($i = 0; $i < count($group_members); $i++) {
            GroupMembers::create([
                'group_id' => $request->group_id,
                'employee_id' => $group_members[$i]
            ]);
        }

        return back()->with('success', 'Anggota kelompok berhasil ditambahkan.');
    }
}
