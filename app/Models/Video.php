<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'url',
        'cover',
        'length',
        'charges',
        'earnable',
        'earned_after',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getVideoIdAttribute()
    {
        parse_str(parse_url($this->url)['query'], $params);
        $video_id = $params['v'];
        return $video_id;
    }

    public function getCoverPathAttribute()
    {
        return asset("cover/$this->cover");
    }
}
