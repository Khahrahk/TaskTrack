<?php

namespace App\Models;

use App\Models\Presenters\WorkspacePresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workspace extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'creator',
        'token'
    ];

    public function users(): HasMany
    {
        return $this->HasMany(UserWorkspace::class, 'workspace_id', 'id');
    }

    public function projects(): HasMany
    {
        return $this->HasMany(Project::class, 'workspace_id', 'id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'creator');
    }

    public function presenter(): WorkspacePresenter
    {
        return new WorkspacePresenter($this);
    }
}
