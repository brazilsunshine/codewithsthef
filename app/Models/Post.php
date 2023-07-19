<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

    public $appends = [
        'diffForHumans',
    ];

    /**
     * Return the sluggable configuration array for this model.
     */
    public function sluggable(): array
    {
        return [
            'slug_en' => [
                'source' => 'title',
                'onUpdate' => true,
            ],
        ];
    }

    /**
     * Here I am making the diffForHumans available in my Vue
     */
    public function getDiffForHumansAttribute ()
    {
        return $this->created_at->diffForHumans();
    }


    /**   RELATIONSHIPS   */
    // post belongs to user
    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
