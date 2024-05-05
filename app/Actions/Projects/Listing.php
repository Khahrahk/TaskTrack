<?php

namespace App\Actions\Projects;

use Illuminate\Support\Facades\Auth;
use App\Models\{Project};
use App\View\Components\Button;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class Listing
{
    private array $sorts;

    public function __construct(private Request $request)
    {
        $this->sorts = [
            'name' => ['using' => false, 'direction' => 'desc', 'label' => 'Name', 'id' => 0],
        ];
    }

    private function buildQuery()
    {
        $req = Project::query()->whereHas('workspace', fn($query)=>$query->whereHas('users', fn($query)=>$query->where('user_id', Auth::id())));
        return $req;
    }

    public function get(): array
    {
        $sorting = str('');
        $result['data'] = $this->buildQuery()->get();
        $result['data']->transform(static function (Project $project) {
            $name = Blade::renderComponent((new Button(link: true, label: $project->presenter()->name(), href: route('projects.show', $project->id)))->withAttributes([ 'primary' => true ]));
//            $name = Blade::renderComponent((new Button(link: true, label: $project->presenter()->name()))->withAttributes([
//                'primary' => true,
//                'data-bs-toggle'=>"modal",
//                'data-bs-target' => "#update-modal",
//                'data-id' => $project->id,
//                'data-name' => $project->name
//            ]));

            return compact('name');
        });

        $result['data'] = $result['data']->toArray();
        $result['sorting'] = $sorting->toString();

        return $result;
    }
}
