<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationHistoriesModel extends Model
{
    use HasFactory;

    protected $table = 'notification_histories';

    protected $fillable = [
        'message',
        'type',
        'platform',
        'receiver',
    ];
}
