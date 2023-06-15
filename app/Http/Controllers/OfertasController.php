<?php

namespace App\Http\Controllers;

use App\Models\Loja;
use App\Models\Subcategoria;
use App\Models\Produto;
use App\Models\Oferta;
use App\Models\Receberoferta;
use Functions;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class OfertasController extends Controller
{



    public function index()
    {
        $ofertas = Oferta::with('loja', 'subcategoria', 'produto')->paginate(25);
        Paginator::useBootstrap();
        return view('oferta.lista', compact('ofertas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        dd('teste');
        $lojas = Loja::select('nome', 'id')->pluck('nome', 'id');
        $subcategorias = Subcategoria::select('nome', 'id')->pluck('nome', 'id');
        $produtos = Produto::select('nome', 'id')->pluck('nome', 'id');
        return view('oferta.formulario', compact('lojas', 'subcategorias', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, ['image.*', 'mimes:jpeg, jpg, gif, png']);
        $pasta = public_path('/uploads/ofertas');
        if ($request->hasFile('imagemproduto')){
            $foto = $request->file('imagemproduto');
            $miniatura = Image::make($foto->path());
            $nomeArquivo = $request->file('imagemproduto')->getClientOriginalName();
            if(!$miniatura->resize(500,500, function ($constraint){
                $constraint->aspectRatio();
            })
            ->save($pasta.'/'.$nomeArquivo)){
                $nomeArquivo = "semfoto.jpg";
            }
        }else{
            $nomeArquivo='semfoto.jpg';

        }
        $oferta = new Oferta();
        $oferta->fill($request->all());
        if ($oferta->save()) {
            $tipo = 'mensagem_sucesso';
            $msg = "Reserva salvo!";

            // fazer ele enviar os e-mail

            $funcoes = new Functions();
            $receberOfertas = Receberoferta::all();
            foreach ($receberOfertas as $receber) {
                $dados = array('receber'=>$receber ,'oferta'=>$oferta); // o que vai ir para a view
                $funcoes->sendEmail($receber->email,
                                    $receber->nome,
                                    "Tem oferta nova",
                                    $dados,
                                    "pechinchador@email.com",
                                    "Pechinchador",
                                    ["saory.bonacolse@gmail.com"],
                                    "email.ofertas");
            }


        } else {
            $tipo = 'mensagem_erro';
            $msg = 'Deu erro';
        }
        return Redirect::to('oferta/create')
            ->with($tipo, $msg);
    }


    /**
     * Display the specified resource.
     */
    public function show(Oferta $oferta)
    {
        $oferta = Oferta::findOrFail($oferta->id);
        $lojas = Loja::select('nome', 'id')->pluck('nome', 'id');
        $subcategorias = Subcategoria::select('nome', 'id')->pluck('nome', 'id');
        $produtos = Produto::select('nome', 'id')->pluck('nome', 'id');
        return view('oferta.formulario', compact('lojas', 'subcategorias', 'produtos', 'oferta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Oferta $oferta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Oferta $oferta)
    {
        $oferta = Oferta::findOrFAil($oferta->id);

        $this->validate($request, ['image.*', 'mimes:jpeg, jpg, gif, png']);
        $pasta = public_path('/uploads/ofertas');
        if ($request->hasFile('imagemproduto')){
            $foto = $request->file('imagemproduto');
            $miniatura = Image::make($foto->path());
            $nomeArquivo = $request->file('imagemproduto')->getClientOriginalName();
            if(!$miniatura->resize(500,500, function ($constraint){
                $constraint->aspectRatio();
            })
            ->save($pasta.'/'.$nomeArquivo)){
                $nomeArquivo = "semfoto.jpg";
            }
        }else{
            $nomeArquivo= $oferta->imagemproduto;
        }

        $oferta->fill($request->all());

        if ($oferta->save()) {
            $tipo = 'mensagem_sucesso';
            $msg = "Reserva alterado!";
            
        } else {
            $tipo = 'mensagem_erro';
            $msg = 'Deu erro';
        }
        return Redirect::to('oferta/' . $oferta->id)
            ->with($tipo, $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Oferta $oferta)
    {
        $oferta = Oferta::findOrFAil($oferta->id);
        $lOk = true;
        if(!empty($oferta->imagemproduto)){
            if($oferta->imagemproduto != 'semfoto.jpg'){
                $lOk = unlink(public_path('uploads/ofertas/').$oferta->imagemproduto);
            }
        }
        if($lOk) {

         if ($oferta->delete()) {
        $tipo = 'mensagem_sucesso';
        $msg = "Reserva removido!";
         } else {
        $tipo = 'mensagem_erro';
        $msg = 'Deu erro';
    }
}
        return Redirect::to('oferta')->with($tipo, $msg);
    }
}
