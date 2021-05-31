<?php


namespace App\Strategies\Interactives;


use BotMan\BotMan\Messages\Conversations\Conversation;

class NotFound extends Conversation implements IStrategy {
    
    public function run()
    {
        $this->say('Accion no encontrada');
    }
}