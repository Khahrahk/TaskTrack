<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'id', 'account_id');
    }

    public function issues(): HasMany
    {
        return $this->HasMany(Issue::class, 'project_id', 'id');
    }
}
