<?php


namespace App\Strategies\Interactives;


use App\Conversations\Interactives;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class Img extends Conversation implements IStrategy {
    
    use ReturnOrExit;
    
    public function run()
    {
        // TODO: Implement run() method.
        $attachment=new Image('https://picsum.photos/200/300');
        $response=OutgoingMessage::create('Este es mi nuevo producto')
            ->withAttachment($attachment);
        $this->say($response);
        $this->returnOrExit(Interactives::class);
    }
}