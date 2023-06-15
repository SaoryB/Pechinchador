@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Dados das Subcategorias
                        <a href="{{ url('subcategorias') }}" class="btn btn-success btn-sm float-end">
                            Listar Subcategorias
                        </a>
                    </div>
                    <div class="card-body">
                        @if(Session::has('mensagem_sucesso'))
                            <div class="alert alert-success">
                                {{ Session::get('mensagem_sucesso') }}
                            </div>
                        @endif
                        @if(Session::has('mensagem_erro'))
                            <div class="alert alert-danger">
                                {{ Session::get('mensagem_erro') }}
                            </div>
                        @endif

                        @if(Route::is('subcategorias.show'))
                            {!! Form::model($subcategoria,
                                            ['method'=>'PATCH',
                                            'url'=>'subcategorias/'.$subcategoria->id]) !!}
                        @else
                            {!! Form::open(['method'=>'POST', 'url'=>'subcategorias']) !!}
                        @endif
                        {!! Form::label('nome', 'Nome') !!}
                        {!! Form::input('text', 'nome',
                                        null,
                                        ['class'=>'form-control',
                                         'placeholder'=>'Nome',
                                         'required',
                                         'maxlength'=>150,
                                         'autofocus']) !!}
                        {!! Form::label('categoria_id', "categoria") !!}
                        {!! Form::select('categoria_id',
                                         $categorias,
                                         null,
                                         ['class'=>'form-control',
                                         'placeholder'=>'Selecione a categoria',
                                         'required']) !!}
                        {!! Form::submit('Salvar',
                                        ['class'=>'float-end btn btn-primary mt-3']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
