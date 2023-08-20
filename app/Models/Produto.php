<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected  $fillable = array(
        'nome',
        'valor'
    );


    public function getProdutosPesquisarIndex(string $pesquisar = '')
    {

        return $this->where(function ($query) use ($pesquisar){
            if($pesquisar){
                $query->where('nome', $pesquisar);
                $query->orWhere('nome', 'LIKE' , "%$pesquisar%");
            }
        })->get();
    }
}
