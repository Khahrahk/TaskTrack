<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\UserWorkspace;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

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
}
