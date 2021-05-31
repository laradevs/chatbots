<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable=[
        'question','cost','responses','level'
    ];
    
    protected $casts=[
      'responses'=>'json'
    ];
}
