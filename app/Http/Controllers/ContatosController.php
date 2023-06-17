<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Models\Contato;
use App\Models\Functions;

class ContatosController extends Controller
{
    public function index()
    {
        return view('public_view.contato');
    }

    public function enviar(Request $request)
    {

        $dest_name = "Saory";
        $dest_email = "saory.bonacolse@gmail.com";
        $dados = array(
            'nome' => $request['nome'],
            'email' => $request['email'],
            'fone' => $request['fone'],
            'mensagem' => $request['mensagem']
        );

        $funcoes = new Functions();
        $bcc = ['saory.bonacolse@gmail.com'];
        if ($funcoes->sendEmail(
            $dest_email,
            $dest_name,
            "E-mail do site da Famper!",
            $dados,
            $request['email'],
            $request['nome'],
            $bcc,
            'email.contato'
        ))
        $contatos = new Contato();
        $contatos->nome = $request->nome;
        $contatos->email = $request->email;
        $contatos->fone = $request->fone;
        $contatos->mensagem = $request->mensagem;
        $contatos->save();
        {

            return Redirect::to('contatos')
            ->with('mensagem_sucesso', 'E-mail enviado com sucesso!');
        }
    }
}
/*
        Mail::send(
            'email.contato',
            $dados,
            function ($mensagem) use ($dest_name, $dest_email, $request) {
                $mensagem->to($dest_email, $dest_name)
                    ->subject('E-mail do site Famper!')
                    ->bcc(['saory.bonacolse@gmail.com']);
                $mensagem->from($request['email'], $request['nome']);


            }
        );
        */
