<?php


namespace App\Strategies\Operations;


class Add implements IStrategy {
    
    public function process()
    {
        return 'Operación aritmética que consiste en reunir varias cantidades en una sola; se representa con el signo +.';
    }
}