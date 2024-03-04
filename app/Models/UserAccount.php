<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'user_id',
        'account_id'
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'id', 'user_id');
    }

    public function account(): BelongsTo
    {
        return $this->BelongsTo(Account::class, 'id', 'account_id');
    }
}
