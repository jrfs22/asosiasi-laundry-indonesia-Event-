<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RewardHistoriesModel extends Model
{
    use HasFactory;

    protected $table = 'reward_histories';

    protected $fillable = [
        'reward_id',
        'referral_id',
    ];

    public function referral(): BelongsTo
    {
        return $this->belongsTo(ReferralsModel::class, 'referral_id', 'id');
    }
}
