<?php

namespace App\Actions\Issues;

use Illuminate\Support\Facades\Auth;
use App\Models\Issue;
use App\View\Components\Button;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class Listing
{
    private array $sorts;

    public function __construct(private Request $request)
    {
        $this->sorts = [
            'name' => ['using' => false, 'direction' => 'desc', 'label' => 'Наименование', 'id' => 0],
        ];
    }

    private function buildQuery()
    {
        $req = Issue::query()->whereHas('project', fn($query)=>$query->whereHas('workspace', fn($query)=>$query->whereHas('users', fn($query)=>$query->where('user_id', Auth::id()))));
        return $req;
    }

    public function get(): array
    {
        $sorting = str('');
        $result['data'] = $this->buildQuery()->get();
        $result['data']->transform(static function (Issue $issue) {
            $name = Blade::renderComponent((new Button(link: true, label: $issue->presenter()->name()))->withAttributes(['primary' => true]));
            return compact('name');
        });

        $result['data'] = $result['data']->toArray();

        collect($this->sorts)->each(function ($sort) use (&$sorting, &$result) {
            if ($sort['using']) {
                $order = 'order-0';
                $component = new Button(link: true, color: 'monochrome', label: $sort['label'], iconLeft: $sort['direction'] === 'asc' ? 'l-sort-az' : 'l-sort-za');
            } else {
                $order = 'order-1';
                $component = new Button(link: true, color: 'primary', label: $sort['label']);
            }

            $render = Blade::renderComponent($component->withAttributes(['class' => 'gap-5px whitespace-nowrap', 'data-label' => $sort['id'], 'data-sorting' => $sort['direction']]));
            $sorting = $sorting->append('<div class="table-sort-mobile-item d-flex align-items-center ' . $order . '">' . $render . '</div>');
        });
        $result['sorting'] = $sorting->toString();
        return $result;
    }
}
