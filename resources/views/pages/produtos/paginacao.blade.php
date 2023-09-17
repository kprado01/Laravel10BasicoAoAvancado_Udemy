@extends('index')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Produtos</h1>
    </div>
    <div>
        <form action="{{route('produto.index')}}" method="get">
            <input type="search" class=""  name="pesquisar" placeholder="Digite o nome">
            <button class="btn btn-dark">Pesquisar</button>
            <a type="button" href="{{route('produto.cadastrarProduto')}}" class="btn btn-success float-end">
                Incluir Produto
            </a>
        </form>
        <div class="table-responsive mt-4">
            @if($produtos->isEmpty())
                <p>Produto não encontrato</p>
            @else
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Valor</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($produtos as $produto)
                        <tr>
                            <td>{{$produto->nome}}</td>
                            <td>{{ 'R$' . ' ' . number_format($produto->valor, 2, ",", ".")}}</td>
                            <td>
                                <a href="{{route('produto.atualizarProduto', $produto->id)}}" class="btn btn-sm btn-secondary">Editar</a>
                                <meta name="csrf-token" content="{{ csrf_token() }}" />
                                <a onclick="deleteRegistroPaginacao('{{route('produto.delete')}}', {{$produto->id}})" class="btn btn-sm btn-danger">Excluir</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            @endif
    </div>
@endsection