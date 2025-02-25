<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    /** @use HasFactory<\Database\Factories\AnimalFactory> */
    use HasFactory;

    protected $table = 'animal';

    public $timestamps = false;

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_classe');
    }

    public function alimentacao()
    {
        return $this->belongsTo(Classe::class, 'id_alimentacao');
    }
}
