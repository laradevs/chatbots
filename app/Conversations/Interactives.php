<?php

namespace App\Conversations;

use App\Values\Interactive;
use App\Values\Operator;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class Interactives extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askInteractive();
    }
    
    private function askInteractive()
    {
        $question=Question::create('Que deseas hacer?')
            ->fallback('No se pudo responder la pregunta')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('Nuevo Producto')->value('0'),
                Button::create('Preguntas')->value('1'),
                Button::create('Ver Video')->value('2'),
                Button::create('Validar')->value('3'),
            ]);
        return $this->ask($question,function (Answer $answer){
            if($answer->isInteractiveMessageReply()){
                $content=Interactive::getStrategy($answer->getValue());
                $this->getBot()->startConversation(new $content());
            }
        });
    }
    
}
