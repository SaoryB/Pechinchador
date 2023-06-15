<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class CategoriasController extends Controller
{

    public function index(){
        $categorias = Categoria::paginate(25);
        Paginator::useBootstrap();
        return view('categoria.lista', compact('categorias'));
    }


    public function create(){
        return view('categoria.formulario');

    }

    public function store(Request $request){
        $categoria = new Categoria();
        $categoria->fill($request->all());
        if ($categoria->save()){;
        $request->session()->flash('mensagem_sucesso',"Categoria salva!");
        }else{
        $request->session()->flash('mensagem_erro',"Deu erro!");
        }
        return Redirect::to('categoria/create');
    }

    public function update(Request $request, $categoria_id){
        $categoria = Categoria::findOrFail($categoria_id);
        $categoria->fill($request->all());
        if ($categoria->save()){;
        $request->session()->flash('mensagem_sucesso',"Categoria alterado!");
        }else{
        $request->session()->flash('mensagem_erro',"Deu erro!");
        }
        return Redirect::to('categoria/'.$categoria->id);
    }

    public function show($id){
        $categoria = Categoria::findOrFail($id);
        return view('categoria.formulario', compact('categoria'));

    }

    public function destroy(Request $request, $categoria_id){
        $categoria = Categoria::findOrFail($categoria_id);
        $categoria->delete();
        $request->session()->flash('mensagem_sucesso',
            'Categoria removida com sucesso');
        return Redirect::to('categoria');

    }

}
