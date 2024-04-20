<?php

namespace App\Actions\Projects;

use App\Models\{Department, User};
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
            'fullName' => ['using' => false, 'direction' => 'desc', 'label' => 'Сотрудник', 'id' => 0],
            'department' => ['using' => false, 'direction' => 'desc', 'label' => 'Департамент', 'id' => 1],
            'group' => ['using' => false, 'direction' => 'desc', 'label' => 'Отдел', 'id' => 2],
            'team' => ['using' => false, 'direction' => 'desc', 'label' => 'Команда', 'id' => 3],
            'email' => ['using' => false, 'direction' => 'desc', 'label' => 'E-mail', 'id' => 4],
            'phone' => ['using' => false, 'direction' => 'desc', 'label' => 'Телефон', 'id' => 5],
            'telegram' => ['using' => false, 'direction' => 'desc', 'label' => 'Телеграм', 'id' => 6],
        ];
    }

    private function buildQuery(): LengthAwarePaginator
    {
        $page = ($this->request->input('start') + $this->request->input('length')) / $this->request->input('length');
        $req = User::query()->withWhereHas('dcAccount', fn($query) => $query->whereNotNull('data->departmentnumber')->with('department.parent', 'department.children'))->whereNotNull('firstName')->whereBlocked(false);
        if ($this->request->has('filter')) {
            foreach ($this->request->get('filter') as $key => $value) {
                if (!$value || trim($value) === '') {
                    continue;
                }
                switch ($key) {
                    case 'fullName':
                        $req->where(fn($query) => $query
                            ->where('firstName', 'LIKE', "%$value%")
                            ->orWhere('lastName', 'LIKE', "%$value%")
                        );
                        break;
                    case 'department':
                        $req->withWhereHas('dcAccount', fn($query) => $query
                            ->withWhereHas('department', fn($query) => $query
                                ->where('department_id', $value)
                                ->orWhere('parent_id', $value)
                            )
                        );
                        break;
                    case 'group':
                        $req->withWhereHas('dcAccount', fn($query) => $query
                            ->withWhereHas('department', fn($query) => $query
                                ->where('department_id', $value)
                            )
                        );
                        break;
                    case 'team':
                        $req->withWhereHas('dcAccount', fn($query) => $query
                            ->withWhereHas('team', fn($query) => $query
                                ->where('team_id', $value)
                            )
                        );
                        break;
                    case 'email':
                        $req->where('email', 'LIKE', "%$value%");
                        break;
                    case 'phone':
                        $req->withWhereHas('dcAccount', fn($query) => $query
                            ->where('data->telephonenumber', 'LIKE', "%$value%")
                        );
                        break;
                    case 'telegram':
                        $req->withWhereHas('dcAccount', fn($query) => $query
                            ->where('data->wwwhomepage', 'LIKE', '%' . $value . '%')
                        );
                        break;
                }
            }
        }
        if ($this->request->has('order')) {
            foreach ($this->request->get('order') as $order) {
                switch ($order['column']) {
                    case 0:
                        $this->sorts['fullName']['using'] = true;
                        $this->sorts['fullName']['direction'] = $order['dir'];
                        $req->orderBy('firstName', $order['dir']);
                        break;
                    case 1:
                        $this->sorts['department']['using'] = true;
                        $this->sorts['department']['direction'] = $order['dir'];
                        $req->withAggregate('dcAccount', 'data')
                            ->orderBy('dc_account_data->department', $order['dir']);
                        break;
                    case 2:
                        $this->sorts['group']['using'] = true;
                        $this->sorts['group']['direction'] = $order['dir'];
                        $req->withAggregate('dcAccount', 'data')
                            ->orderBy('dc_account_data->department', $order['dir']);
                        break;
                    case 3:
                        $this->sorts['team']['using'] = true;
                        $this->sorts['team']['direction'] = $order['dir'];
                        $req->withAggregate('dcAccount', 'data')
                            ->orderBy('dc_account_data->team', $order['dir']);
                        break;
                    case 4:
                        $this->sorts['email']['using'] = true;
                        $this->sorts['email']['direction'] = $order['dir'];
                        $req->orderBy('email', $order['dir']);
                        break;
                    case 5:
                        $this->sorts['phone']['using'] = true;
                        $this->sorts['phone']['direction'] = $order['dir'];
                        $req->withAggregate('dcAccount', 'data')
                            ->orderBy('dc_account_data->telephonenumber', $order['dir']);
                        break;
                    case 6:
                        $this->sorts['telegram']['using'] = true;
                        $this->sorts['telegram']['direction'] = $order['dir'];
                        $req->withAggregate('dcAccount', 'data')
                            ->orderBy('dc_account_data->wwwhomepage', $order['dir']);
                        break;
                }
            }
        }
        return $req->paginate($this->request->input('length'), ['*'], 'page', $page);
    }

    public function get(): array
    {
        $sorting = str('');
        $result = $this->buildQuery();
        $result->getCollection()->transform(static function (User $user) {
            $data = $user->dcAccount->data;
            $component = Blade::renderComponent((new Button(link: true, label: $user->presenter()->fullName(), href: route('user.show', $user->login)))->withAttributes(['primary' => true]));
            $fullName = '<div class="d-flex flex-row"><div class="d-flex flex-column px-1 justify-content-top"><img class="profile-icon rounded-circle outline-none" src="' . $user->presenter()->avatar() . '"></div><div class="d-flex flex-column"><div>' . $component . '</div><div class="fs-14">' . data_get($data, 'title') . '</div></div></div>';
            $department = '';
            $group = '';
            $team = data_get($data, 'team', '');
            $phone = '';
            $telegram = '';

            if ($departmentName = $user->presenter()->departmentName()){
                $component = new Button(link: true, href: '/organization/departments/'.str_replace(' ', '_', $departmentName), label: $departmentName);
                $department = Blade::renderComponent($component);
            }
            if ($groupName = $user->presenter()->groupName()){
                $component = new Button(link: true, href: '/organization/departments/'.$user->presenter()->dcDepartmentUrl(), label: $groupName);
                $group = Blade::renderComponent($component);
            }

            if ($email = $user->email) {
                $component = new Button(link: true, label: $email, href: "mailto:$email");
                $email = Blade::renderComponent($component->withAttributes(['primary' => true]));
            }

            if ($phoneNumber = $user->presenter()->dcPhoneNumber()) {
                $component = new Button(link: true, label: $phoneNumber, href: "tel:+$phoneNumber");
                $phone = Blade::renderComponent($component->withAttributes(['primary' => true]));
            }

            if (!empty($value = $user->presenter()->dcTelegram())) {
                $component = new Button(link: true, label: $value, href: 'https://t.me/' . str($value)->replace('@', '')->toString());
                $telegram = Blade::renderComponent($component->withAttributes(['primary' => true]));
            }

            return compact('fullName', 'department', 'group', 'team', 'email', 'phone', 'telegram');
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
