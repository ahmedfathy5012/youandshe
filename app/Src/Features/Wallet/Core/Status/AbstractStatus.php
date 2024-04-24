<?php

namespace Src\Features\Wallet\Core\Status;

abstract class AbstractStatus
{
    protected int $status;

    public function status():int
    {
        return $this->status;
    }
}
