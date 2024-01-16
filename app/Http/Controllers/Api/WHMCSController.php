<?php

namespace App\Http\Controllers\Api;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class WHMCSController extends Controller
{
    //
    public function CheckAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ext_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = User::where('ext_id', $request->ext_id)->first();

        if ($user) {
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false], 404);
        }

        return true;
    }

    public function CreateAccount(Request $request)
    {
        $validatior = Validator::make($request->all(), [
            'ext_id' => 'required|integer',
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'password' => 'nullable|string',

            'plan_id' => 'required|integer',
            'project_name' => 'required|string',
            'project_description' => 'required|string',
            'project_url' => 'required|url',
        ]);

        if ($validatior->fails()) {
            return response()->json(['error' => $validatior->errors()], 401);
        }

        $user = User::where('ext_id', $request->ext_id)->first();

        if (!$user) {
            $userValidation = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            if ($userValidation->fails()) {
                return response()->json(
                    ['error' => $userValidation->errors()],
                    401
                );
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'ext_id' => $request->ext_id,
                'password' => bcrypt($request->password),
            ]);
        }

        $project = $user->projects()->create([
            'name' => $request->project_name,
            'description' => $request->project_description,
            'url' => $request->project_url,
            'plan_id' => $request->plan_id,
            'status' => 'active',
        ]);

        $features = Plan::find($request->plan_id)->features;

        foreach ($features as $feature => $value) {
            $project->custom_fields->$feature = 0;
        }

        $project->save();

        return response()->json(
            ['success' => true, 'project_id' => $project->id],
            200
        );
    }

    public function SuspendAccount(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'project_id' => 'required|integer',
            'ext_id' => 'required|integer',
        ]);

        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()], 401);
        }

        $user = User::where('ext_id', $request->ext_id)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $project = $user
            ->projects()
            ->where('id', $request->project_id)
            ->first();

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        $project->status = 'suspended';

        $project->save();

        return response()->json(['success' => true], 200);
    }

    public function UnsuspendAccount(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'project_id' => 'required|integer',
            'ext_id' => 'required|integer',
        ]);

        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()], 401);
        }

        $user = User::where('ext_id', $request->ext_id)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $project = $user
            ->projects()
            ->where('id', $request->project_id)
            ->first();

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        $project->status = 'active';

        $project->save();

        return response()->json(['success' => true], 200);
    }

    public function TerminateAccount(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'project_id' => 'required|integer',
            'ext_id' => 'required|integer',
        ]);

        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()], 401);
        }

        $user = User::where('ext_id', $request->ext_id)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $project = $user
            ->projects()
            ->where('id', $request->project_id)
            ->first();

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        $project->status = 'terminated'; // queue for deletion in 30 days

        $project->save();

        $deletion_queue = Carbon::now()->addDays(30);

        return response()->json(
            ['success' => true, 'deletion_queue' => $deletion_queue],
            200
        );
    }

    public function ChangePassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'project_id' => 'required|integer',
            'ext_id' => 'required|integer',
            'password' => 'required|string',
        ]);

        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()], 401);
        }

        $user = User::where('ext_id', $request->ext_id)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $project = $user
            ->projects()
            ->where('id', $request->project_id)
            ->first();

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        $user->password = bcrypt($request->password);

        $user->save();

        return response()->json(['success' => true], 200);
    }

    public function RenewAccount(Request $request)
    {
        // set project to active

        $validation = Validator::make($request->all(), [
            'project_id' => 'required|integer',
            'ext_id' => 'required|integer',
        ]);

        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()], 401);
        }

        $user = User::where('ext_id', $request->ext_id)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $project = $user
            ->projects()
            ->where('id', $request->project_id)
            ->first();

        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        $project->status = 'active';

        $project->save();

        return response()->json(['success' => true], 200);
    }
}
