<?php

namespace App\Http\Controllers;

use App\Actions\Issues\Listing;
use App\Models\Issue;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class IssueController extends BaseController
{
    public function index(){
        return view('issue.index');
    }

    public function create(Request $request){
        $data = $request->validate([
            "name" => ["required", "string"],
            "project" => ["required", "integer"],
        ]);

        Issue::create([
            "name" => $data["name"],
            "project_id" => $data['project'],
            'user_id' => auth()->user()->id,
            'type' => 3
        ]);

        return redirect(route("issues"));
    }

    public function delete(Request $request){
        $data = $request->validate([
            "id" => ["required"],
        ]);

        Issue::query()->where('id', '=', $data['id'])->first()->delete();

        return redirect(route("issues"));
    }

    /**
     * Issue paginated list
     *
     * @param Request $request
     * @return JsonResponse
     *
     * @group Issues
     * @queryParam start int Value to start from. Defaults to 1. Example: 1
     * @queryParam page int Page number. Defaults to 1. Example: 1
     * @queryParam length int Page length. Defaults to 10. Example: 10
     */
    public function issueList(Request $request): JsonResponse
    {
        $result = (new Listing($request))->get();
        return response()->json($result);
    }
}
