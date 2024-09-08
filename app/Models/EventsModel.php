<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventsModel extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'user_id',
        'name',
        'poster',
        'date',
        'start_time',
        'end_time',
        'max_participants',
        'status'
    ];

    public function participants(): HasMany
    {
        return $this->hasMany(ParticipantsModel::class, 'event_id', 'id');
    }
}
