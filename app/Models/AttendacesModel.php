<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendacesModel extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'event_id',
        'registration_id',
        'participant_id',
        'type'
    ];

    public function participant(): BelongsTo
    {
        return $this->belongsTo(ParticipantsModel::class);
    }
}
