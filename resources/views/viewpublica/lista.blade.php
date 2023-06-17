@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Lista de Ofertas
                        <a href="{{ url('verofertas/create') }}" class="btn btn-success btn-sm float-end">
                            Nova Oferta
                        </a>
                    </div>
                    <div class="card-body">
                        @if(Session::has('mensagem_sucesso'))
                            <div class="alert alert-success">
                                {{ Session::get('mensagem_sucesso') }}
                            </div>
                        @endif
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Subcategoria</th>
                                    <th>Produto</th>
                                    <th>Descrição</th>
                                    <th>Imagem do Produto</th>
                                    <th>Data de Vencimento</th>
                                    <th>Link</th>
                                    <th>Loja</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($ofertas as $oferta)
                                    <tr>
                                        <td>{{ $oferta->id }}</td>
                                        <td>{{ $oferta->subcategoria->nome }}</td>
                                        <td>{{ $oferta->produto->nome }}</td>
                                        <td>{{ $oferta->descricao }}</td>
                                        <td><img src="uploads/ofertas/{{ $oferta->imagemproduto }}" height="50" alt=""></td>
                                        <td>{{ $oferta->datavencimento }}</td>
                                        <td>{{ $oferta->link }}</td>
                                        <td>{{ $oferta->loja->nome }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">
                                            Não há itens para listar!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="pagination justify-content-center">
                            {{ $ofertas->links() }}
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="text-center">Ficou com alguma dúvida ou tem alguma sugestão? Entre em contato conosco através do botão abaixo!!</div>
    <div class="text-center">
        <br/>
        <a href="{{ url('contatos') }}" class="btn btn-success btn-sm">
            Entrar em Contato
        </a>
    </div>
    <br/>
    <div class="text-center">Gostaria de receber um aviso a cada nova oferta? Basta cliclar no botão abaixo e cadastrar seu e-mail!</div>
    </div>
    <div class="text-center">
    <br/>
    <a href="{{ url('aviso/create') }}" class="btn btn-success btn-sm">
        Receber E-mail
    </a>
    </div>
@endsection
