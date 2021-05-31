<?php


namespace App\Strategies\Interactives;


use App\Conversations\Interactives;
use BotMan\BotMan\Messages\Conversations\Conversation;

class Validate extends Conversation implements IStrategy {
    
    use ReturnOrExit;
    
    public function run()
    {
        // TODO: Implement run() method.
        $this->ask('Escribe lo que deseas saber hora o fecha',[
            [
                'pattern'=>'hora|hh|h',
                'callback'=>function(){
                    $this->say(date('H:i:s'));
                    $this->returnOrExit(Interactives::class);
                }
            ],
            [
                'pattern'=>'fecha|f|fe',
                'callback'=>function(){
                    $this->say(date('d/m/Y'));
                    $this->returnOrExit(Interactives::class);
                }
            ]
        ]);
    }
}