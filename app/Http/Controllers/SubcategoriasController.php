<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use App\Models\Categoria;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class SubcategoriasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategorias = Subcategoria::with('categoria')->paginate(25);
        Paginator::useBootstrap();
        return view('subcategoria.lista', compact('subcategorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::select('nome', 'id')->pluck('nome', 'id');
        return view('subcategoria.formulario', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subcategoria = new Subcategoria();
        $subcategoria->fill($request->all());
        if ($subcategoria->save()){
            $tipo = 'mensagem_sucesso';
            $msg = "Subcategoria salva!";
        } else {
            $tipo = 'mensagem_erro';
            $msg = 'Deu erro';
        }
        return Redirect::to('subcategoria/create')
                    ->with($tipo, $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategoria $subcategoria)
    {
        $subcategoria = Subcategoria::findOrFail($subcategoria->id);
        $categorias = Categoria::select('nome', 'id')->pluck('nome', 'id');
        return view('subcategoria.formulario', compact('categorias', 'subcategoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategoria $subcategoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategoria $subcategoria)
    {
        $subcategoria = Subcategoria::findOrFAil($subcategoria->id);
        $subcategoria->fill($request->all());
        if ($subcategoria->save()){
            $tipo = 'mensagem_sucesso';
            $msg = "Subcategoria alterada!";
        } else {
            $tipo = 'mensagem_erro';
            $msg = 'Deu erro';
        }
        return Redirect::to('subcategorias/'.$subcategoria->id)
                    ->with($tipo, $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategoria $subcategoria)
    {
        $subcategoria = Subcategoria::findOrFAil($subcategoria->id);
        if ($subcategoria->delete()){
            $tipo = 'mensagem_sucesso';
            $msg = "Subcategoria removida! ";
        } else {
            $tipo = 'mensagem_erro x';
            $msg = 'Deu erro';
        }
        return Redirect::to('subcategoria')->with($tipo, $msg);
    }

    public function showReport(){
        $subcategorias = Subcategoria::get();
        $pdf = Pdf::loadView('reports.subcategorias', compact('subcategorias'));

        $pdf->setPaper('a4', 'portrait')
            ->setOptions(['dpi'=>150, 'defaultFont'=>'sans-serif'])
            ->setEncryption('123');

        return $pdf
        //download('relatorio.pdf');
        //->save(public_path('/arquivos/relatorio.pdf'));
        ->stream('relatorio.pdf');
    }
    }
