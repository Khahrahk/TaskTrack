<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class IssueServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('issue.index', function () {
            $issueTypeData = collect(json_decode(file_get_contents(base_path('resources/data/issue_type.json'))));
            $issuePriorityData = collect(json_decode(file_get_contents(base_path('resources/data/issue_priority.json'))));
            $issueStatusData = collect(json_decode(file_get_contents(base_path('resources/data/issue_status.json'))));

            View::share('issueData', collect(['issueType' => $issueTypeData, 'issueStatus' => $issueStatusData, 'issuePriority' => $issuePriorityData]));
        });
    }
}
