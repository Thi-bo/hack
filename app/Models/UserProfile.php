<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'user_id', 'score', 'totlesub', 'last_sub_time'];

    protected $primaryKey = 'id';
    protected $keyType = 'string';  // Indique que la clé primaire est une string
    public $incrementing = false;   // Désactive l'auto-incrémentation
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::random(8);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
