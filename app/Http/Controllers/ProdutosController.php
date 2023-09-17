<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRequestProduto;
use App\Models\Componentes;
use App\Models\Produto;
use Brian2694\Toastr\Facades\Toastr as ToastrA;
use Brian2694\Toastr\Toastr;
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
        $componentes = new Componentes();
        $valor = filter_var(
            $componentes->formataValorCasasDecimais($request->valor),
            FILTER_VALIDATE_FLOAT
        );

        Produto::create(["nome" => $nome, "valor" => $valor]);
        ToastrA::success('Cliente cadastrato com sucesso');
        return redirect()->route('produto.index');
    }

    public function atualizarProduto(FormRequestProduto $request, $id)
    {
        if($request->method() == "GET"){
            $produto = Produto::where('id', $id)->first();
            return view('pages.produtos.atualiza', compact('produto'));
        }

        $nome = htmlspecialchars($request->nome);
        $componentes = new Componentes();
        $valor = filter_var(
            $componentes->formataValorCasasDecimais($request->valor),
            FILTER_VALIDATE_FLOAT
        );
        $buscaProduto = Produto::find($id);
        $buscaProduto->update(["nome" => $nome, "valor" => $valor]);
        ToastrA::success("Cliente $nome alterado com sucesso");
        return redirect()->route('produto.index');
    }
}
