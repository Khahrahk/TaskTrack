<?php

namespace App\Models\Presenters;

class UserPresenter extends Presenter
{
    public function initials()
    {
        $name = $this->fullName();
        $nameParts = explode(' ', trim($name));
        return count($nameParts) === 1
            ? strtoupper(mb_substr($name, 0, 2))
            : strtoupper(mb_substr($nameParts[0], 0, 1) . mb_substr(end($nameParts), 0, 1));
    }

    public function fullName()
    {
        $name = trim(implode(' ', [$this->entity->firstName, $this->entity->lastName]));
        return $name ?: $this->entity->login;
    }

    public function title(): string
    {
        return '';
    }

    public function subTitle(): string
    {
        return '';
    }

    public function label(): string
    {
        return '';
    }

    public function singularLabel(): string
    {
        return '';
    }

    public function perSearchShow(): int
    {
        return 0;
    }

    public function url(): string
    {
        return '';
    }

}
