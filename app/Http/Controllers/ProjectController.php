<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $projects = Project::where('user_id', '=', auth()->user()->id)
            ->with('plan')
            ->latest();

        if ($request->has('search')) {
            $projects->where('name', 'like', "%{$request->search}%");
        }

        $projects = $projects->paginate(25);

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        //
        $timelines = $project
            ->timeline()
            ->latest()
            ->paginate(25);
        return view('projects.show', compact('project', 'timelines'));
    }
}
