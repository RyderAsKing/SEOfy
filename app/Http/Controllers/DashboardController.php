<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $users = 0;
        $projects = 0;
        $active_projects = 0;

        if (auth()->user()->is_admin) {
            $users = User::all()->count();
            $projects = Project::all()->count();
            $plans = Plan::all()->count();
        }
        return view('dashboard', compact('users', 'projects', 'plans'));
    }
}
