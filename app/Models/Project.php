<?php

namespace App\Models;

use App\Models\Presenters\ProjectPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'workspace_id'
    ];

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class, 'id', 'workspace_id');
    }

    public function issues(): HasMany
    {
        return $this->HasMany(Issue::class, 'project_id', 'id');
    }

    public function presenter(): ProjectPresenter
    {
        return new ProjectPresenter($this);
    }
}
