<?php

namespace App\Mail;

use App\Models\Scheduling;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewSchedulingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $scheduling;

    public function __construct(Scheduling $scheduling)
    {
        $this->scheduling = $scheduling;
    }

    public function build()
    {
        return $this->subject('Novo Agendamento Realizado')
                    ->view('emails.new_scheduling'); // Vamos criar esta view agora
    }
}