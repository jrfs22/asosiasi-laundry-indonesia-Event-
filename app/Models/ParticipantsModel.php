<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function registration(): BelongsTo
    {
        return $this->belongsTo(RegistrationModel::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(AttendacesModel::class, 'participant_id', 'id');
    }
}
