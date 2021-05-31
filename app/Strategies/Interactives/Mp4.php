<?php


namespace App\Strategies\Interactives;


use App\Conversations\Interactives;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Attachments\Video;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class Mp4 extends Conversation implements IStrategy {
    use ReturnOrExit;
    
    public function run()
    {
        // TODO: Implement run() method.
        $attachment=new Video('https://samplelib.com/lib/preview/mp4/sample-5s.mp4',[
            'custom_payload'=>true
        ]);
        $response=OutgoingMessage::create('Este es mi nuevo video del producto')
            ->withAttachment($attachment);
        $this->say($response);
        $this->returnOrExit(Interactives::class);
    }
}