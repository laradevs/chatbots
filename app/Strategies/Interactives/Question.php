<?php


namespace App\Strategies\Interactives;


use App\Conversations\Interactives;
use App\InteractiveData;
use App\Mail\SendDataEmail;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\Mail;

class Question extends Conversation implements IStrategy {
    
    use ReturnOrExit;
    
    public function run()
    {
        $this->askName(new InteractiveData());
    }
    
    private function askName( InteractiveData $param )
    {
        $this->ask("Cual es tu nombre?",function (Answer $answer) use($param){
           $param->name=$answer->getText();
           if(trim($param->name)==''){
               $this->askName($param);
           }else{
               $this->askLastName($param);
           }
        });
    }
    private function askLastName( InteractiveData $param )
    {
        $this->ask("Cual es tu apellido?",function (Answer $answer) use($param){
            $param->lastname=$answer->getText();
            if(trim($param->lastname)==''){
                $this->askLastName($param);
            }else{
                $this->askAddress($param);
            }
        });
    }
    private function askAddress( InteractiveData $param )
    {
        $this->ask("Cual es tu direccion?",function (Answer $answer) use($param){
            $param->address=$answer->getText();
            if(trim($param->address)==''){
                $this->askAddress($param);
            }else{
                $this->askEmail($param);
            }
        });
    }
    private function askEmail( InteractiveData $param )
    {
        $this->ask("Cual es tu email?",function (Answer $answer) use($param){
            $param->email=$answer->getText();
            if(!filter_var($param->email,FILTER_VALIDATE_EMAIL)){
                $this->askEmail($param);
            }else{
                $this->finish($param);
            }
        });
    }
    private function finish(InteractiveData $param){
        if(InteractiveData::query()->where('email','=',$param->email)->count()==0){
            $param->save();
        }
      Mail::to($param->email)->send(new SendDataEmail($param));
        $this->say("Mucho gusto ".$param->name.' '.$param->lastname.' que vive en:'.$param->address.' y el correo de contacto es: '.$param->email);
        $this->returnOrExit(Interactives::class);
    }
}