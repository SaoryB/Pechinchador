<?php

namespace App\Http\Controllers;

use App\Models\Loja;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class LojasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listar(){
        $lojas = Loja::paginate(25);
        Paginator::useBootstrap();

        return view('loja.lista', compact('lojas'));
        //$tipos = Tipo::all();
        // return view('tipo', ['tipos' => $tipos]);
    }

    public function create(){
        return view('loja.formulario');
    }

    public function store(Request $request){
        $loja = new Loja();
        $loja->fill($request->all());
        if ($loja->save()){
            $request->session()->flash('mensagem_sucesso', "Loja salva!");
        } else {
            $request->session()->flash('mensagem_erro', 'Deu erro');
        }
        return Redirect::to('loja/create');
    }

    public function update(Request $request, $loja_id){
        $loja = Loja::findOrFail($loja_id);
        $loja->fill($request->all());
        if ($loja->save()){
            $request->session()->flash('mensagem_sucesso', "Loja alterado!");
        } else {
            $request->session()->flash('mensagem_erro', 'Deu erro');
        }
        return Redirect::to('loja/'.$loja->id);
    }

    public function show($id){
        $loja = Loja::findOrFail($id);
        return view('loja.formulario', compact('loja'));
    }

    public function deletar(Request $request, $loja_id){
        $loja = Loja::findOrFail($loja_id);
        $loja->delete();
        $request->session()->flash('mensagem_sucesso',
            'Loja removida com sucesso');
        return Redirect::to('loja');
    }

    public function showReport(){
    $lojas = Loja::get();
    $pdf = Pdf::loadView('reports.lojas', compact('lojas'));

    $pdf->setPaper('a4', 'portrait')
        ->setOptions(['dpi'=>150, 'defaultFont'=>'sans-serif'])
        ->setEncryption('123');

    return $pdf
    //download('relatorio.pdf');
    //->save(public_path('/arquivos/relatorio.pdf'));
    ->stream('relatorio.pdf');
}
}
