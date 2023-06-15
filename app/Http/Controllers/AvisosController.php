<?php

namespace App\Http\Controllers;

use App\Models\Aviso;
use App\Models\Receberoferta;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class AvisosController extends Controller
{
    public function index()
    {
        $receberofertas = Receberoferta::paginate(25);
        Paginator::useBootstrap();
        return view('avisos.lista', compact('receberofertas'));
    }


    public function create()
    {
        return view('avisos.formulario');

    }


    public function store(Request $request){
        $receberoferta = new Receberoferta();
        $receberoferta->fill($request->all());
        if ($receberoferta->save()){;
        $request->session()->flash('mensagem_sucesso',"Receberoferta salva!");
        }else{
        $request->session()->flash('mensagem_erro',"Deu erro!");
        }
        return Redirect::to('aviso/create');
    }

    public function update(Request $request, $receberoferta_id){
        $receberoferta = Receberoferta::findOrFail($receberoferta_id);
        $receberoferta->fill($request->all());
        if ($receberoferta->save()){;
        $request->session()->flash('mensagem_sucesso',"Receberoferta alterado!");
        }else{
        $request->session()->flash('mensagem_erro',"Deu erro!");
        }
        return Redirect::to('aviso/'.$receberoferta->id);
    }

}
