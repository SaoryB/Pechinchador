@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Dados das Ofertas
                        <a href="{{ url('verofertas') }}" class="btn btn-success btn-sm float-end">
                            Listar Ofertas
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

                        @if(Route::is('verofertas.show'))
                            {!! Form::model($oferta,
                                            ['method'=>'PATCH',
                                            'url'=>url('verofertas',$oferta->id)]) !!}
                        @else
                            {!! Form::open(['method'=>'POST', 'url'=>url('verofertas')]) !!}
                        @endif
                        {!! Form::label('subcategoria_id', "Subcategoria") !!}
                        {!! Form::select('subcategoria_id',
                                         $subcategorias,
                                         null,
                                         ['class'=>'form-control',
                                         'placeholder'=>'Selecione a subcategoria',
                                         'required']) !!}
                        {!! Form::label('produto_id', "Produto") !!}
                        {!! Form::select('produto_id',
                                         $produtos,
                                         null,
                                         ['class'=>'form-control',
                                         'placeholder'=>'Selecione o produto',
                                         'required']) !!}
                        {!! Form::label('descricao','Descrição') !!}
                        {!! Form::input('text','descricao', null, ['class'=>'form-control',
                                                    'placeholder'=>'Descrição',
                                                    'required',
                                                    'maxlength' =>50,
                                                    'autofocus']) !!}
                        {!! Form::label('imagemproduto','Imagem Produto') !!}
                        {!! Form::file('imagemproduto',['class'=>'form-control btn-sm']) !!}
                        {!! Form::label('datavencimento', 'Data de Vencimento da Oferta') !!}
                        {!! Form::input('date', 'datavencimento',
                                        null,
                                        ['class'=>'form-control',
                                        'placeholder'=>'Data',
                                        'required']) !!}
                        {!! Form::label('link','Link') !!}
                        {!! Form::input('text','link', null, ['class'=>'form-control',
                                                     'placeholder'=>'Link',
                                                     'required',
                                                     'maxlength' =>50,
                                                     'autofocus']) !!}
                        {!! Form::label('loja_id', "Loja") !!}
                        {!! Form::select('loja_id',
                                         $lojas,
                                         null,
                                         ['class'=>'form-control',
                                         'placeholder'=>'Selecione a loja',
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
