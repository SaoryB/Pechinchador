<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class ProdutosController extends Controller
{

    public function index(){
        $produtos = Produto::paginate(25);
        Paginator::useBootstrap();
        return view('produto.lista', compact('produtos'));
    }


    public function create(){
        return view('produto.formulario');

    }

    public function store(Request $request){
        $produto = new Produto();
        $produto->fill($request->all());
        if ($produto->save()){;
        $request->session()->flash('mensagem_sucesso',"Produto salvo!");
        }else{
        $request->session()->flash('mensagem_erro',"Deu erro!");
        }
        return Redirect::to('produto/create');
    }

    public function update(Request $request, $produto_id){
        $produto = Produto::findOrFail($produto_id);
        $produto->fill($request->all());
        if ($produto->save()){;
        $request->session()->flash('mensagem_sucesso',"Produto alterado!");
        }else{
        $request->session()->flash('mensagem_erro',"Deu erro!");
        }
        return Redirect::to('produto/'.$produto->id);
    }

    public function show($id){
        $produto = Produto::findOrFail($id);
        return view('produto.formulario', compact('produto'));

    }

    public function destroy(Request $request, $produto_id){
        $produto = Produto::findOrFail($produto_id);
        $produto->delete();
        $request->session()->flash('mensagem_sucesso',
            'Produto removido com sucesso');
        return Redirect::to('produto');

    }

    public function showReport(){
        $produtos = Produto::get();
        $pdf = Pdf::loadView('reports.produtos', compact('produtos'));

        $pdf->setPaper('a4', 'portrait')
            ->setOptions(['dpi'=>150, 'defaultFont'=>'sans-serif'])
            ->setEncryption('123');

        return $pdf
        //download('relatorio.pdf');
        //->save(public_path('/arquivos/relatorio.pdf'));
        ->stream('relatorio.pdf');
    }
    }
