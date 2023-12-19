<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $projects = Project::with('plan')->latest();

        if ($request->has('search')) {
            $projects->where('name', 'like', "%{$request->search}%");
        }

        $projects = $projects->paginate(25);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // plans
        $plans = Plan::all();
        $users = User::all();

        return view('admin.projects.create', compact('plans', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'url' => 'required',
            'plan_id' => 'required',
            'user_id' => 'required',
        ]);

        $project = Project::create($request->all());

        // get all the features (key) from the Plan model and attach them to the project model (key)
        // example if the plan has 3 features, attach all 3 features to the project but the value will be 0

        $features = Plan::find($request->plan_id)->features;

        foreach ($features as $feature => $value) {
            $project->custom_fields->$feature = 0;
        }

        $project->save();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
        $timelines = $project
            ->timeline()
            ->latest()
            ->paginate(25);
        return view('admin.projects.show', compact('project', 'timelines'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function timeline_create(Project $project)
    {
        return view('admin.projects.timeline.create', compact('project'));
    }

    public function timeline_store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $project->timeline()->create($request->all());

        return redirect()
            ->route('admin.projects.show', $project)
            ->with('success', 'Timeline created successfully.');
    }

    public function timeline_edit(Project $project, $timeline_id)
    {
        $timeline = $project->timeline()->findOrFail($timeline_id);

        return view(
            'admin.projects.timeline.edit',
            compact('project', 'timeline')
        );
    }

    public function timeline_update(
        Request $request,
        Project $project,
        $timeline_id
    ) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $timeline = $project->timeline()->findOrFail($timeline_id);

        $timeline->update($request->all());

        return redirect()
            ->route('admin.projects.show', $project)
            ->with('success', 'Timeline updated successfully.');
    }

    public function timeline_destroy(Project $project, $timeline_id)
    {
        $timeline = $project->timeline()->findOrFail($timeline_id);

        $timeline->delete();

        return redirect()
            ->route('admin.projects.show', $project)
            ->with('success', 'Timeline deleted successfully.');
    }
}
