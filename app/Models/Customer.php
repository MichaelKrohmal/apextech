<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'date_of_birth', 'email'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date'
    ];

    public function addresses(): HasMany
    {
        return $this->HasMany(Address::class);
    }

    public function applications(): HasMany
    {
        return $this->HasMany(Application::class);
    }
}
