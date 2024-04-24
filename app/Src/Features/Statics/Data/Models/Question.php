<?php

namespace Src\Features\Statics\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model 
{

    protected $table = 'questions';
    public $timestamps = true;
    protected $fillable = array('question', 'answer', 'for_who');
    protected $visible = array('question', 'answer', 'for_who');

}