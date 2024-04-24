<?php

namespace Src\Features\Blog\Data\Repositories;

use Src\Base\Repositories\Repository;
use Src\Features\Blog\Data\Models\Blog;

class BlogRepository extends Repository
{

    public function __construct(Blog $blog)
    {
        $this->setModel($blog);
    }
}
