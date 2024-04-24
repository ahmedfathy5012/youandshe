<?php
use Src\Features\Wallet\Core\Status\AbstractStatus;

class DepositeStatus extends AbstractStatus{
    


    public function status():int
    {   
        $this->status = 0;
        return $this->status;
    }
   
}