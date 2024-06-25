<?php

namespace App\Models;

use App\Models\Presenters\ProjectPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function issues(): HasMany
    {
        return $this->HasMany(Issue::class, 'status_id', 'id');
    }
}
