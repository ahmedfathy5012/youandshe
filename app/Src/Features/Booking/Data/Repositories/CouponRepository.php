<?php

namespace Src\Features\Booking\Data\Repositories;

use Src\Base\Repositories\Repository;
use Src\Features\Booking\Data\Models\Coupon;

class CouponRepository extends Repository
{

    public function __construct(Coupon $coupon)
    {
      $this->setModel($coupon);
    }
}
