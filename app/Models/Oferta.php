<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;

    protected $fillable = ['subcategoria_id', 'produto_id', 'descricao', 'imagemproduto', 'datavencimento', 'link', 'loja_id'];

    public function subcategoria(){
        return $this->belongsTo(Subcategoria::class);
    }

    public function produto(){
        return $this->belongsTo(Produto::class);
    }

    public function loja(){
        return $this->belongsTo(Loja::class);
    }
}
