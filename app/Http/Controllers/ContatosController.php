<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Models\Contato;
use Functions;

class ContatosController extends Controller
{
    public function index()
    {
        return view('public_view.contato');
    }

    public function enviar(Request $request)
    {
        $contato = new Contato();
        $contato->nome = $request->nome;
        $contato->email = $request->email;
        $contato->fone = $request->fone;
        $contato->mensagem = $request->mensagem;
        $contato->save();

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
        if ($funcoes->sendEmail($dest_email, $dest_name, "E-mail do site da Famper!",
                            $dados, $request['email'], $request['nome'], $bcc, 'email.contato')){

                return Redirect::to('contatos')
                ->with('mensagem_sucesso', 'E-mail enviado com sucesso!');
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
    }
}
