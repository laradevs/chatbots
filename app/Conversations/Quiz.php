<?php

namespace App\Conversations;

use App\Question;
use App\Result;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

class Quiz extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->startQuiz();
    }
    
    private function startQuiz()
    {
        $this->ask("Cual es tu email?",function (Answer $answer){
            $email=$answer->getText();
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $this->startQuiz();
            }else{
                if(Result::where( 'email', '=', $email )->count() > 0 ){
                    $this->say('No puedes participar tu email ya fue ingresado');
                    $this->getScore($email);
                }else{
                    $this->buildQuestion(1,$email);
                }
               
            }
        });
    }
    
    private function buildQuestion( int $level, string $email )
    {
        $qDB=Question::query()->where('level','=',$level)->first();
        if(is_null($qDB)){
            $this->say('Finalizado el examen');
            $this->getScore($email);
            
        }else{
            $responses=[];
            foreach ($qDB->responses as $response){
                $responses[]=Button::create($response['title'])->value($response['is_correct']);
            }
            $question=\BotMan\BotMan\Messages\Outgoing\Question::create($qDB->question)
                ->fallback( 'no se pudo responder la pregunta' )
                ->callbackId( 'ask_reason' )
                ->addButtons($responses);
            
            $this->ask($question,function (Answer $answer) use($level,$email,$qDB){
                if($answer->isInteractiveMessageReply()){
                    if($answer->getValue()=='S'){
                        Result::create([
                            'email'=>$email,
                            'question_id'=>$qDB->id,
                            'cost'=>$qDB->cost
                        ]);
                        $this->buildQuestion($level+1,$email);
                    }else{
                        $this->say('Fallaste la respuesta');
                       $this->getScore($email);
                    }
                }
            });
        }
    }
    
    private function getScore( string $email )
    {
        $this->say('Tu score es: '.Result::where('email','=',$email)->sum('cost'));
    }
}
