<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendDataEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $model;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($model)
    {
        $this->model=$model;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Mensaje de larabot');
        return $this->view('mail',[
            'name'=>$this->model->name,
            'lastname'=>$this->model->lastname,
            'address'=>$this->model->address
        ]);
    }
}
