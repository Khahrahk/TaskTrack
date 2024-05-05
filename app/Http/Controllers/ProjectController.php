<?php

namespace App\Http\Controllers;

use App\Actions\Projects\Listing;
use App\Http\Requests\Project\ProjectStoreRequest;
use App\Http\Requests\Project\ProjectUpdateRequest;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ProjectController extends BaseController
{
    public function index(){
        return view('project.index');
    }

    public function show(Request $request){
        $project = Project::find($request->id);
        return view('project.show', compact('project'));
    }

    public function update(ProjectUpdateRequest $request)
    {
        $validated = $request->validated();
        try {
            $issue = Project::find($validated['id']);
            $issue->update([
                'name' => $validated['name'],
            ]);
            return ['status' => true];
        } catch (\Throwable) {
            return ['status' => false, 'data' => 'Ошибка'];
        }
    }

    public function store(ProjectStoreRequest $request)
    {
        $validated = $request->validated();
        try {
            Project::create([
                "name" => $validated["name"],
                "workspace_id" => $validated['workspace'],
            ]);
            return ['status' => true];
        } catch (\Throwable) {
            return ['status' => false, 'data' => 'Ошибка'];
        }
    }

    public function delete(Request $request)
    {
        $request->validate(['id' => 'required']);
        try {
            $issue = Project::find($request->id);
            $issue->delete();
            return ['status' => true];
        } catch (\Throwable) {
            return ['status' => false, 'data' => 'Ошибка'];
        }
    }

    /**
     * Project paginated list
     *
     * @param Request $request
     * @return JsonResponse
     *
     * @group Projects
     * @queryParam start int Value to start from. Defaults to 1. Example: 1
     * @queryParam page int Page number. Defaults to 1. Example: 1
     * @queryParam length int Page length. Defaults to 10. Example: 10
     */
    public function projectList(Request $request): JsonResponse
    {
        $result = (new Listing($request))->get();
        return response()->json($result);
    }
}
