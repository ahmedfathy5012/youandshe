<?php
use Src\Features\Wallet\Core\Status\AbstractStatus;

class WithDrawStatus extends AbstractStatus{
    


    public function status():int
    {   
        $this->status = 1;
        return $this->status;
    }
   
}