<?php

namespace Src\Features\Barber\Data\Repositories;

use Src\Base\Repositories\Repository;
use Src\Features\Barber\Data\Models\Barber;
use Src\Features\Barber\Data\Models\Review;

class ReviewRepository extends  Repository
{
    public function __construct(Review $review)
    {
        $this->setModel($review);
    }
}
