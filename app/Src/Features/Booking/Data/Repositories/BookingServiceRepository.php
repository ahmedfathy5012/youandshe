<?php

namespace Src\Features\Booking\Data\Repositories;

use Src\Base\Repositories\Repository;
use Src\Features\Booking\Core\Requests\CheckPriceRequest;
use Src\Features\BaseApp\Data\Models\Package;
use Src\Features\BaseApp\Data\Models\Service;
use Src\Features\Booking\Data\Models\Booking;
use Src\Features\Booking\Data\Models\BookingService;
use Src\Features\Booking\Data\Models\Coupon;
use Src\Features\Booking\Data\Models\Price;

class BookingServiceRepository extends Repository
{

    public function __construct(BookingService $bookingService)
    {
        $this->setModel($bookingService);
    }

}
