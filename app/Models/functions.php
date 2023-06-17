
<?php

use Illuminate\Support\Facades\Mail;

class Functions
{
    public function sendEmail($dest_email, $dest_name, $assunto, $dados, $from_email, $from_name, $bcc, $view){
        Mail::send(
            $view,
            $dados,
            function ($mensagem) use ($dest_name, $dest_email, $assunto, $from_email, $from_name, $bcc) {
                $mensagem->to($dest_email, $dest_name)
                    ->subject($assunto)
                    ->bcc($bcc);
                $mensagem->from($from_email, $from_name);

                return true;
            }
        );
        return false;
    }
}
