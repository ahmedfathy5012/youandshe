<?php

namespace Src\Features\Booking\Data\Repositories;

use Src\Base\Repositories\Repository;
use Src\Features\Booking\Data\Models\CancelReason;
use Src\Features\Booking\Data\Models\Coupon;

class CancelReasonRepository extends Repository
{

    public function __construct(CancelReason $cancelReason)
    {
      $this->setModel($cancelReason);
    }
}
