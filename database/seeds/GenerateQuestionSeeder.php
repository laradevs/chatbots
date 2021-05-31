<?php

use Illuminate\Database\Seeder;

class GenerateQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::transaction(function (){
           \App\Question::create(
               [
                   'question'=>'Que es laravel?',
                   'cost'=>20,
                   'level'=>1,
                   'responses'=>[
                       ['title'=>'Un lenguaje de programacion','is_correct'=>'N'],
                       ['title'=>'Un framework de frontend','is_correct'=>'N'],
                       ['title'=>'Un framework de backend','is_correct'=>'S'],
                   ]
               ]
           );
            \App\Question::create([
                'question'=>'Cuales son los metodos de un Rest?',
                'cost'=>30,
                'level'=>2,
                'responses'=>[
                    ['title'=>'GET,POST','is_correct'=>'N'],
                    ['title'=>'POST,DELETE','is_correct'=>'N'],
                    ['title'=>'GET,POST,PUT,PATCH,DELETE','is_correct'=>'S'],
                ]
            ]);
            
            \App\Question::create([
                'question'=>'Que es VUEJS?',
                'cost'=>50,
                'level'=>3,
                'responses'=>[
                    ['title'=>'Una libreria','is_correct'=>'N'],
                    ['title'=>'Un framework fronted','is_correct'=>'S'],
                    ['title'=>'Un plugin del navegador','is_correct'=>'N'],
                ]
            ]);
        });
    }
}
