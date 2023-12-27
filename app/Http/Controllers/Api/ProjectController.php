<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Mail\NewProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Project\Store;
use App\Http\Requests\Project\Update;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $projects = Project::query()
            // ->with(['customer', 'createdBy'])
            ->when($request->q, function ($query) use ($request) {
                $query->search($request->q);
            })
            ->applyFilters($request)
            ->latest()
            ->when($request->perPage, function ($query, $perPage) {
                return $query->paginate($perPage);
            }, function ($query) {
            return $query->get();
        });

        return ProjectResource::collection($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request)
    {

        $project = Project::create(array_merge($request->validated(), [
            'created_by' => auth()->id(),
        ]));

        // $project = Project::with([ 'createdBy'])->find($project->id);

        // Mail::to($project->customer->email)->send(new NewProject($project));

        return response()->json([
            'message' => 'Project created successfully.',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load(['user', 'createdBy']);

        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, Project $project)
    {

        $project->update($request->validated());

        return response()->json([
            'message' => 'Project updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json([
            'message' => 'Project deleted successfully.',
        ]);
    }

    // updateStatus

    public function updateStatus(Request $request, $projectId)
    {

        $project = Project::find($projectId);

        $project->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'message' => 'Project status updated successfully.',
        ]);
    }


    // projects count by status
    public function projectsCountByStatus(Request $request)
    {
        // projects count by status for last week 
        $projects = Project::query()
            ->selectRaw('count(*) as count, status')
            ->whereBetween('created_at', [now()->subWeek(), now()])
            ->groupBy('status')
            ->get();


        return response()->json([
            'data' => $projects,
        ]);
    }

    // send project

    public function sendProject(Request $request)
    {

        $project = Project::with(['customer', 'createdBy'])->find($request->id);

        Mail::to($project->customer->email)->send(new NewProject($project));

        return response()->json([
            'message' => 'Project sent successfully.',
        ]);
    }
}