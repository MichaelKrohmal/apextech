<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CreditProduct extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'interest_rate', 'term'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'interest_rate' => 'decimal:2',
        'term' => 'integer'
    ];

    public function applications(): HasMany
    {
        return $this->HasMany(Application::class);
    }
}
