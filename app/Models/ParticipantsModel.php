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
        'registration_id',
        'laundry_name',
        'name',
        'phone_number',
        'certificate_name',
        'type',
        'qrcode'
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(EventsModel::class);
    }
}
