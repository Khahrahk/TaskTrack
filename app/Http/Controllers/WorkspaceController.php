<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserWorkspace;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class WorkspaceController extends BaseController
{
    public function index(){
        $workspaces = User::query()->with('userWorkspace', fn($query)=>$query->with('workspace'))->get();
        return view('workspace.index');
    }

    public function create(Request $request){
        $data = $request->validate([
            "name" => ["required", "string"],
        ]);

        $workspace = Workspace::create([
            "name" => $data["name"],
            "creator" => auth()->user()->id,
            "token" => Str::random(32)
        ]);

        UserWorkspace::create([
            'user_id' => auth()->user()->id,
            'user_type' => 0,
            'workspace_id' => $workspace->id
        ]);

        return redirect(route("workspaces"));
    }

    public function join(Request $request){
        $data = $request->validate([
            "token" => ["required", "string"],
        ]);

        $workspace = Workspace::query()->where('token', '=', $data['token'])->firstorFail();

        if($workspace){
            UserWorkspace::create([
                'user_id' => auth()->user()->id,
                'user_type' => 3,
                'workspace_id' => $workspace->id
            ]);
        }

        return redirect(route("workspaces"));
    }
}
