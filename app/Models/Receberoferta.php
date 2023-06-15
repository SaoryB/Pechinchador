<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receberoferta extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email'];
    protected $table = 'receberofertas';
}
