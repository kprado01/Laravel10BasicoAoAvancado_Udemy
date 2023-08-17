<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProcutosController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();

        return view('pages.produtos.paginacao', compact('produtos'));
    }
}
