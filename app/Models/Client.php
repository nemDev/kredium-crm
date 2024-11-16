<?php

namespace App\Models;

use App\Models\CashLoan;
use App\Models\HomeLoan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'adviser_id'
    ];

    /**
     * Get the user associated with the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cashLoan(): HasOne
    {
        return $this->hasOne(CashLoan::class);
    }

    /**
     * Get the user associated with the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function homeLoan(): HasOne
    {
        return $this->hasOne(HomeLoan::class);
    }
}
