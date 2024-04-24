<?php

namespace Src\Features\Wallet\Data\Models;

use Illuminate\Database\Eloquent\Model;

class WalletHistory extends Model 
{

    protected $table = 'wallet_histories';
    public $timestamps = true;
    protected $fillable = array('transaction_type', 'amount', 'barber_id', 'booking_id', 'percentage');
    protected $visible = array('transaction_type', 'amount', 'barber_id', 'booking_id', 'percentage');

}