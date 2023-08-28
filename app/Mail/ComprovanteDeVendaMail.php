<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ComprovanteDeVendaMail extends Mailable
{
    use Queueable, SerializesModels;
    
    // vamos incluir o atritubo '#mailData'
    public $mailData;

    // passo o atributo criado anteriormente como parâmetro no parâmetro deste construtor
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            // assunto do e-mail
            subject: 'Comprovante De Venda',
        );
    }

    public function content(): Content
    {
        return new Content(
            // adicionar a view que contém o contéudo para ser enviado no e-mail
            view: 'email.comprovante_email',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
