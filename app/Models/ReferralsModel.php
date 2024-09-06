<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReferralsModel extends Model
{
    use HasFactory;

    protected $table = 'referrals';

    protected $fillable = [
        'referrer_id',
        'referred_id',
        'points'
    ];


    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'referred_id');
    }
}
