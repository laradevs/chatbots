<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('Hi|Hola', function ($bot) {
    $bot->reply($bot->getUser()->getId());
    $bot->reply('Hola como estas!');
});
$botman->hears('conversar', BotManController::class.'@startConversation');
$botman->hears('matematicas',BotManController::class.'@startOperations');
$botman->hears('interactivo',BotManController::class.'@startInteractive');
$botman->hears('examen', BotManController::class.'@startQuiz');

$botman->hears('stop',function (\BotMan\BotMan\BotMan $botMan){
    $botMan->reply('chat detenido');
})->stopsConversation();

$botman->fallback(function(\BotMan\BotMan\BotMan $bot) {
    $bot->reply('Para interactuar ingresa lo siguiente:');
    $bot->reply('hola');
    $bot->reply('matematicas');
    $bot->reply('interactivo');
    $bot->reply('conversar');
});