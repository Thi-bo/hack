<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class UserProfile extends Model
{
    use HasFactory;

      protected $fillable = ['id',
        'latest_sub_time',
        'totlesub',
        'password',
        'name',
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
        return $this->belongsTo(User::class ,'user_id');
    }
}
