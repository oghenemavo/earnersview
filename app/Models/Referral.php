<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'referrer_user_id',
        'referred_user_id',
        'bonus',
        'status',
        'bonus_at',
        'credited_at',
    ];
    
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_user_id');
    }
    
    public function referred()
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }
}
