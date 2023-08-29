<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestProduto;
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

    public function delete(Request $request)
    {
        $id = $request->id;
        $produto = Produto::find($id);
        $produto->delete();
        return response()->json(['success' => true]);
    }

    public function cadastrarProduto(FormRequestProduto $request)
    {
        if($request->method() == "GET"){
            return view('pages.produtos.create');
        }
        $nome = htmlspecialchars($request->nome);

        $valor = filter_var($request->valor, FILTER_VALIDATE_FLOAT);

        Produto::create(["nome" => $nome, "valor" => $valor]);

        return redirect()->route('produto.index');
    }
}
