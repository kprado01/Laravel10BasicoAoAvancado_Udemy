<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function __construct()
    {
        $this->produto = new Produto();
    }
    public function index(Request $request)
    {
        $pesquisar = $request->has('pesquisar') ?
                filter_var($request->pesquisar, FILTER_SANITIZE_STRING)
                : '';

        $produtos = $this->produto->getProdutosPesquisarIndex($pesquisar);

        return view('pages.produtos.paginacao', compact('produtos'));
    }
}
