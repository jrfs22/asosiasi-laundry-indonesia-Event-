<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RewardsModel extends Model
{
    use HasFactory;

    protected $table = 'rewards';

    protected $fillable = [
        'user_id',
        'total_points',
    ];

    public function history(): HasMany
    {
        return $this->hasMany(RewardHistoriesModel::class, 'reward_id', 'id');
    }
}
