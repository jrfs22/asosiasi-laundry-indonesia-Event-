<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantsModel extends Model
{
    use HasFactory;

    protected $table = 'participants';

    protected $fillable = [
        'registration_id',
        'name',
        'phone_number',
        'certificate_name',
        'type'
    ];
}
