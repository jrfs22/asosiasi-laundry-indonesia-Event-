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
        'name',
        'email',
        'phone_number',
        'tickets',
        'amount',
        'discount_percentage',
        'discount_total',
        'source',
        'member',
        'payment_status',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(EventsModel::class);
    }
}
