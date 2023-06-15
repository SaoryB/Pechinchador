@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Lista de Subcategoria
                        <a href="{{ url('subcategorias/create') }}" class="btn btn-success btn-sm float-end">
                            Nova Subcategoria
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
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subcategorias as $subcategoria)
                                    <tr>
                                        <td>{{ $subcategoria->id }}</td>
                                        <td>{{ $subcategoria->nome }}</td>
                                        <td>{{ $subcategoria->categoria->nome }}</td>
                                        <td>
                                            <a href="{{ url('subcategorias/' . $subcategoria->id) }}" class="btn btn-primary btn-sm">
                                                Editar
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'url' => 'subcategorias/' . $subcategoria->id, 'style' => 'display:inline']) !!}
                                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                            {!! Form::close() !!}
                                        </td>
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
                            {{ $subcategorias->links() }}
                        </div>
                        <div class="card-footer">
                            <a href="{{ url('subcategorias/report') }}" target="_blank"
                            class="btn btn-sm btn-warning">
                                Relatório
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
