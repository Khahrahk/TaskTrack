<?php

namespace App\Http\Controllers;

use App\Actions\Issues\Listing;
use App\Http\Requests\Issue\IssueStoreRequest;
use App\Http\Requests\Issue\IssueUpdateRequest;
use App\Models\Issue;
use App\Models\Project;
use App\Models\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class IssueController extends BaseController
{
    public function index()
    {

        return view('issue.index', [
            'pageSubmenu' => [
                ['link' => 'issues.index', 'name' => "List"],
                ['link' => 'issues.board', 'name' => "Board"],
            ],
        ]);
    }

    public function board()
    {
        $statuses = Status::query()->with('issues')->get();
        return view('issue.board', [
            'statuses' => $statuses,
            'pageSubmenu' => [
                ['link' => 'issues.index', 'name' => "List"],
                ['link' => 'issues.board', 'name' => "Board"],
            ],
        ]);
    }

    public function update(IssueUpdateRequest $request)
    {
        $validated = $request->validated();
        try {
            $issue = Issue::find($validated['id']);
            $issue->update([
                'name' => $validated['name'],
                'status_id' => $validated['status'],
            ]);
            return ['status' => true];
        } catch (\Throwable) {
            return ['status' => false, 'data' => 'Ошибка'];
        }
    }

    public function store(IssueStoreRequest $request)
    {
        $validated = $request->validated();
        try {
            Issue::create([
                "name" => $validated["name"],
                "project_id" => 1,
                'user_id' => auth()->user()->id,
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
            $issue = Issue::find($request->id);
            $issue->delete();
            return ['status' => true];
        } catch (\Throwable) {
            return ['status' => false, 'data' => 'Ошибка'];
        }
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
