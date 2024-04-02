<?php

namespace App\Models;

use App\Enums\ApplicationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationStatusHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'application_id', 'old_status', 'new_status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, mixed>
     */
    protected $casts = [
        'old_status' => ApplicationStatus::class,
        'new_status' => ApplicationStatus::class
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

}
