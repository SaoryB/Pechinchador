<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class ContatoController extends Controller
{
    public function index()
    {
        $contatos = Contato::paginate(25);
        Paginator::useBootstrap();
        return view('contato.lista', compact('contatos'));
    }
}
