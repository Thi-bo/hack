<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Writeups extends Model
{
    use HasFactory;

    protected $table = 'writeups';

    protected $fillable = ['id',
        'faciliteAcces',
        'interfaceUtilisateur',
        'noteQuestion',
        'noteIndice',
        'experienceUtilisateur',
        'isRejouer',
        'recommandation',
        'soutienOrganisateur',
        'exeprienceGlobale',
        'commentaires',
        'nomFichier',
        'pathFichier',
        'user_id',
        'user_name'
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
