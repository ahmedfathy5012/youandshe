<?php

namespace Src\Features\Blog\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model 
{

    protected $table = 'blogs';
    public $timestamps = true;
    protected $fillable = array('image', 'title', 'body');
    protected $visible = array('image', 'title', 'body');

}