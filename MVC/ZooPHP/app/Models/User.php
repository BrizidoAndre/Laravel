<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /** 
     * primary key da tabela
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Atributos que pode ser inseridos pelo Seeder
     */
    protected $fillable = [
        'email',
        'password',
        'foto'
    ];

    /**
     * definindo os timestamps como falsos
     */
    public $timestamps = false;
}
