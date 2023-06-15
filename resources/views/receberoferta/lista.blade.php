@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Lista de Cadastro Para Ofertas
                    <a href="{{ url('receberoferta/create') }}" class="btn btn-success btn-sm float-end">
                        Novo Cadastro
                    </a>
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($receberofertas as $receberoferta)
                                <tr>
                                    <td>{{ $receberoferta->id }}</td>
                                    <td>{{ $receberoferta->nome }}</td>
                                    <td>{{ $receberoferta->email }}</td>
                                    <td>
                                        <a href="{{ url('receberoferta/'.$receberoferta->id) }}" class="btn btn-primary btn-sm">
                                            Editar
                                        </a>
                                        {!!  Form::open([
                                            'method' => 'DELETE',
                                            'url' =>'receberoferta/'.$receberoferta->id,
                                            'style'=>'display:inline']) !!}
                                            <button type="submit" class="btn btn-danger btn-sm">
                                            Excluir
                                            </button>
                                        {!!  Form::close() !!}
                                    </td>
                                </tr>
                            @empty
                            <tr><td colspan="3"> Não há itens para listar!</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="pagination justify-content-center">
                        {{ $receberofertas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
