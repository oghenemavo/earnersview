<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'email',
        'amount',
        'tx_ref',
        'is_confirmed',
        'confirmed_at',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
