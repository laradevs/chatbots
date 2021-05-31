<?php

namespace App\Conversations;

use App\Values\Operator;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class Operations extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->askOperations();
    }
    
    private function askOperations()
    {
        $question=Question::create('Que concepto deseas recordar?')
            ->fallback('No se pudo responder la pregunta')
            ->callbackId('ask_reason')
            ->addButtons([
                Button::create('suma')->value('S'),
                Button::create('resta')->value('R'),
                Button::create('multiplicacion')->value('M'),
                Button::create('division')->value('D'),
            ]);
        return $this->ask($question,function (Answer $answer){
            if($answer->isInteractiveMessageReply()){
                    $content=Operator::getStrategy($answer->getValue());
                    $this->say((new $content)->process());
            }
        });
    }
}
