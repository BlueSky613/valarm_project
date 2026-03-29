<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletUser extends Model
{
    protected $fillable = [
        'username',
        'wallet_address',
        'cluster',
        'premium',
        'premium_date',
        'api_token',
    ];

    protected $hidden = [
        'api_token',
    ];

    protected function casts(): array
    {
        return [
            'premium' => 'boolean',
            'premium_date' => 'datetime',
        ];
    }
}
