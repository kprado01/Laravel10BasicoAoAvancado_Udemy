@extends('index')

@section('content')
<form method="post" action="{{route('produto.cadastrarProduto')}}">
    @csrf
    <div class="form-group  mb-3">
        <label>Nome</label>
        <input name="nome" value="{{old('nome')}}" type="text" class="form-control @error('nome') is-invalid @enderror" placeholder="Produto Exemplo">
        @if($errors->has('nome'))
            <div class="invalid-feedback">{{$errors->first('nome')}}</div>
        @endif
    </div>
    <div class="form-group mb-3">
        <label >Valor</label>
        <input  id="mascara_valor"  value="{{old('valor')}}" name="valor" class="form-control @error('valor') is-invalid @enderror"  placeholder="12345,00">
        @if($errors->has('valor'))
            <div class="invalid-feedback">{{$errors->first('valor')}}</div>
        @endif
    </div>
    <button type="submit" class="btn btn-success">Adicionar</button>
</form>
@endsection