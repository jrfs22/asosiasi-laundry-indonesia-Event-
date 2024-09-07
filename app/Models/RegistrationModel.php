<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistrationModel extends Model
{
    use HasFactory;

    protected $table = 'registration';

    protected $fillable = [
        'event_id',
        'tickets',
        'amount',
        'discount',
        'payment_status',
        'qrcode'
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(EventsModel::class);
    }
}
