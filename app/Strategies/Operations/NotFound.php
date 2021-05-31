<?php


namespace App\Strategies\Operations;


class NotFound implements IStrategy {
    
    public function process()
    {
        return 'Operacion no redactada';
    }
}