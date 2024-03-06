<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserWorkspace extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'user_id',
        'workspace_id'
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'id', 'user_id');
    }

    public function workspace(): BelongsTo
    {
        return $this->BelongsTo(Workspace::class, 'workspace_id', 'id');
    }
}
