<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPengaduanMail extends Mailable
{
    use Queueable, SerializesModels;

    public Contact $c;

    public function __construct(Contact $c)
    {
        $this->c = $c;
    }

    public function build()
    {
        return $this
            // kirim ke ADMIN_EMAIL yg sudah di config/mail.php
            ->to(config('mail.admin_email'))
            // set header From sesuai .env
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('🆕 Pengaduan Baru dari '.$this->c->nama)
            ->view('emails.new_pengaduan')
            ->with('c', $this->c);
    }
}