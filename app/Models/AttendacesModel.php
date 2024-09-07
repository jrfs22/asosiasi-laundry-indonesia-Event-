<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendacesModel extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'event_id',
        'registration_id',
        'participant_id',
    ];
}
