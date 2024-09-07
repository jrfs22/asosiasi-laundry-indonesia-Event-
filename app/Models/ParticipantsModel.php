<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParticipantsModel extends Model
{
    use HasFactory;

    protected $table = 'participants';

    protected $fillable = [
        'event_id',
        'name',
        'phone_number',
        'certificate_name',
        'type'
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(EventsModel::class);
    }
}
