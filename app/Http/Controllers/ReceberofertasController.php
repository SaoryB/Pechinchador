<?php

namespace App\Http\Controllers;

use App\Models\Receberoferta;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class ReceberofertasController extends Controller
{

    public function index(){
        $receberofertas = Receberoferta::paginate(25);
        Paginator::useBootstrap();
        return view('receberoferta.lista', compact('receberofertas'));
    }


    public function create(){
        return view('receberoferta.formulario');

    }

    public function store(Request $request){
        $receberoferta = new Receberoferta();
        $receberoferta->fill($request->all());
        if ($receberoferta->save()){;
        $request->session()->flash('mensagem_sucesso',"Receberoferta salva!");
        }else{
        $request->session()->flash('mensagem_erro',"Deu erro!");
        }
        return Redirect::to('receberoferta/create');
    }

    public function update(Request $request, $receberoferta_id){
        $receberoferta = Receberoferta::findOrFail($receberoferta_id);
        $receberoferta->fill($request->all());
        if ($receberoferta->save()){;
        $request->session()->flash('mensagem_sucesso',"Receberoferta alterado!");
        }else{
        $request->session()->flash('mensagem_erro',"Deu erro!");
        }
        return Redirect::to('receberoferta/'.$receberoferta->id);
    }

    public function show($id){
        $receberoferta = Receberoferta::findOrFail($id);
        return view('receberoferta.formulario', compact('receberoferta'));

    }

    public function destroy(Request $request, $receberoferta_id){
        $receberoferta = Receberoferta::findOrFail($receberoferta_id);
        $receberoferta->delete();
        $request->session()->flash('mensagem_sucesso',
            'Receberoferta removida com sucesso');
        return Redirect::to('receberoferta');

    }

}
