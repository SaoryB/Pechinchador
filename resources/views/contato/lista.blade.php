@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Lista de Contatos
                </div>
                <div class="card-body">
                    @if(Session::has('mensagem_sucesso'))
                        <div class="alert alert-success">
                            {{ Session::get('mensagem_sucesso')}}
                        </div>
                    @endif
                    <table class="table rable-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Mensagem</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contatos as $contato)
                                <tr>
                                    <td>{{ $contato->id }}</td>
                                    <td>{{ $contato->nome }}</td>
                                    <td>{{ $contato->email }}</td>
                                    <td>{{ $contato->mensagem }}</td>
                                    <td>
                                </tr>
                            @empty
                            <tr><td colspan="3"> Não há contatos para listar!</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="pagination justify-content-center">
                        {{ $contatos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
