<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyPengaduanMail extends Mailable
{
    use Queueable, SerializesModels;

    public Contact $pengaduan;
    public string  $subjectLine;
    public string  $body;

    public function __construct(Contact $pengaduan, string $subjectLine, string $body)
    {
        $this->pengaduan   = $pengaduan;
        $this->subjectLine = $subjectLine;
        $this->body        = $body;
    }

    public function build()
    {
        return $this
            ->to($this->pengaduan->email)                // kirim ke pelapor
            ->subject($this->subjectLine)                // subject email
            ->view('emails.reply_pengaduan')             // view template
            ->with([
                'pengaduan' => $this->pengaduan,
                'body'      => $this->body,
            ]);
    }
}