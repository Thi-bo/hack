<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Questions extends Model
{
    use HasFactory;

    protected $table = 'questions';
    
    protected $fillable = [
        'id',
       // 'question_id',
        'solved_by',
        //'password',
        'points' ,
        'titre',
        'description',
        'level',
        'hint' ,
         'flag',
        'hint_point' ,
        'file' ,
        'path' ,
        'category' ,
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

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'question_id');
    }

}
