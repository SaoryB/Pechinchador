<?php

namespace App\Http\Controllers;

use App\Models\Loja;
use App\Models\Subcategoria;
use App\Models\Produto;
use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;

class ViewpublicaController extends Controller
{

    public function index()
    {
        $ofertas = Oferta::with('loja', 'subcategoria', 'produto')->paginate(5);
        Paginator::useBootstrap();
        return view('viewpublica.lista', compact('ofertas'));
    }
    public function create()
    {
        $lojas = Loja::select('nome', 'id')->pluck('nome', 'id');
        $subcategorias = Subcategoria::select('nome', 'id')->pluck('nome', 'id');
        $produtos = Produto::select('nome', 'id')->pluck('nome', 'id');
        return view('viewpublica.formulario', compact('lojas', 'subcategorias', 'produtos'));
    }
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
        } else {
            $tipo = 'mensagem_erro';
            $msg = 'Deu erro';
        }
        return Redirect::to('verofertas/create')
            ->with($tipo, $msg);
    }

}
