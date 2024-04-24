<?php

namespace Src\Features\Barber\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Src\Features\Auth\Data\Models\User;

class Review extends Model
{

    protected $table = 'reviews';
    public $timestamps = true;
    protected $fillable = array('comment', 'rate', 'user_id', 'barber_id');
    protected $visible = array('comment', 'rate', 'user_id', 'barber_id');

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function baber()
    {
        return $this->belongsTo(Barber::class);
    }

}
