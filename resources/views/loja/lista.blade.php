@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Lista de Lojas
                    <a href="{{ url('loja/create') }}" class="btn btn-success btn-sm float-end">
                        Nova Loja
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lojas as $loja)
                                <tr>
                                    <td>{{ $loja->id }}</td>
                                    <td>{{ $loja->nome }}</td>
                                    <td>
                                        <a href="{{ url('loja/'.$loja->id) }}" class="btn btn-primary btn-sm">
                                            Editar
                                        </a>
                                        {!!  Form::open([
                                            'method' => 'DELETE',
                                            'url' =>'loja/'.$loja->id,
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
                        {{ $lojas->links() }}
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url('loja/report') }}" target="_blank"
                    class="btn btn-sm btn-warning">
                        Relatório
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
