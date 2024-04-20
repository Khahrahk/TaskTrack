<?php

namespace App\Http\Controllers;

use App\Actions\Projects\Listing;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ProjectController extends BaseController
{
    public function index(){
        return view('project.index');
    }

    public function create(Request $request){
        $data = $request->validate([
            "name" => ["required", "string"],
            "workspace" => ["required", "integer"],
        ]);

        $project = Project::create([
            "name" => $data["name"],
            "workspace_id" => $data['workspace'],
        ]);

        return redirect(route("projects"));
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
     * @queryParam order object order[key] = filter_value column int order[column] Column. 0 - fullName, 1 - department, 2 - group, 3 - team, 4 - email, 5 - phone, 6 - telegram, 7 - questions. Enum: 0, 1, 2, 3, 4, 5, 6, 7. Example: {"column": 0, "dir": "asc"}
     * @queryParam filter object filter[key] = filter_value Filters. Supported keys: 'fullName', 'department', 'group', 'team', 'email', 'phone', 'telegram', 'questions'. Example: [{"fullName": "Алекс"}]
     */
    public function projectList(Request $request): JsonResponse
    {
        $result = (new Listing($request))->get();
        return response()->json($result);
    }
}
