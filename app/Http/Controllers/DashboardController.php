<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $users = 0;
        $projects = 0;
        $plans = 0;

        if (auth()->user()->is_admin) {
            $users = User::all()->count();
            $projects = Project::all()->count();
            $plans = Plan::all()->count();
        } else {
            $projects = Project::where('user_id', auth()->user()->id)->count();
        }
        return view('dashboard', compact('users', 'projects', 'plans'));
    }
}
