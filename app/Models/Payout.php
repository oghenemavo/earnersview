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
        'message',
        'is_notified',
        'attempts',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
