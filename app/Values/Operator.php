<?php


namespace App\Values;


use App\Strategies\Operations\Add;
use App\Strategies\Operations\Divide;
use App\Strategies\Operations\Mult;
use App\Strategies\Operations\NotFound;
use App\Strategies\Operations\Subs;

final class Operator {
    const GET_STRATEGY = [
        'S' => Add::class,
        'R' => Subs::class,
        'M' => Mult::class,
        'D' => Divide::class
    ];
    
    static function getStrategy( $value )
    {
        if ( key_exists( $value, self::GET_STRATEGY ) ) {
            return self::GET_STRATEGY[ $value ];
        }
        return NotFound::class;
    }
}