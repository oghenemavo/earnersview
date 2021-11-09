<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reason',
        'receipt_no',
        'amount',
        'reference',
        'status',
        'is_notified',
        'attempts',
    ];
}
