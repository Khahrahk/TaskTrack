<?php

namespace App\Actions\Projects;

use App\Models\{Project};
use App\View\Components\Button;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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

    private function buildQuery(): LengthAwarePaginator
    {
        $page = ($this->request->input('start') + $this->request->input('length')) / $this->request->input('length');
        $req = Project::query();
//        if ($this->request->has('filter')) {
//            foreach ($this->request->get('filter') as $key => $value) {
//                if (!$value || trim($value) === '') {
//                    continue;
//                }
//                switch ($key) {
//                    case 'name':
//                        $req->where(fn($query) => $query
//                            ->where('name', 'LIKE', "%$value%")
//                            ->orWhere('name', 'LIKE', "%$value%")
//                        );
//                        break;
//                }
//            }
//        }
//        if ($this->request->has('order')) {
//            foreach ($this->request->get('order') as $order) {
//                switch ($order['column']) {
//                    case 0:
//                        $this->sorts['name']['using'] = true;
//                        $this->sorts['name']['direction'] = $order['dir'];
//                        $req->orderBy('name', $order['dir']);
//                        break;
//                }
//            }
//        }
        return $req->paginate($this->request->input('length'), ['*'], 'page', $page);
    }

    public function get(): array
    {
        $sorting = str('');
        $result = $this->buildQuery();
        $result->getCollection()->transform(static function (Project $project) {
            $name = Blade::renderComponent((new Button(link: true, label: $project->presenter()->name()))->withAttributes(['primary' => true]));
            return compact('name');
        });

        $result = $result->toArray();

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
