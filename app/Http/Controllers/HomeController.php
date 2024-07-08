<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Evaluator;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_employee = Employee::count();
        $count_group = Group::count();
        $count_evaluator = Evaluator::count();
        $count_user = User::count();

        return view('home', compact('count_employee', 'count_group', 'count_evaluator', 'count_user'));
    }
}
