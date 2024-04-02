<?php

namespace App\Models;

use App\Enums\ApplicationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            if ($creditProduct = CreditProduct::find($model->attributes['credit_product_id'])) {
                $model->attributes['monthly_payment'] = $model->attributes['loan_amount'] * ($creditProduct->interest_rate / 12);
            }
        });

        self::updating(function ($model) {
            if ($creditProduct = CreditProduct::find($model->attributes['credit_product_id'])) {
                $model->attributes['monthly_payment'] = $model->attributes['loan_amount'] * ($creditProduct->interest_rate / 12);
            }

            if ($model->attributes['status'] != $model->original['status']) {
                ApplicationStatusHistory::create([
                    'application_id' => $model->original['id'],
                    'old_status' => $model->original['status'],
                    'new_status' => $model->attributes['status']
                ]);
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id', 'broker_id', 'credit_product_id',
        'loan_amount', 'monthly_payment', 'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, mixed>
     */
    protected $casts = [
        'status' => ApplicationStatus::class
    ];

    public function customer(): BelongsTo
    {
        return $this->BelongsTo(Customer::class);
    }

    public function broker(): BelongsTo
    {
        return $this->BelongsTo(Broker::class)->withDefault([
            'name' => 'NO_BROKER'
        ]);
    }

    public function credit_product(): BelongsTo
    {
        return $this->BelongsTo(CreditProduct::class);
    }

    public function application_status_histories(): HasMany
    {
        return $this->HasMany(ApplicationStatusHistory::class);
    }

}
