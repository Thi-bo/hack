<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Submission extends Model
{
    use HasFactory;

    protected $fillable = ['id',
        'question_id',
        'user_id',
        'curr_score','sub_time','solved'
    ];

     protected $primaryKey = 'id';

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::random(8);
        });

    }
     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
