<?php

namespace Src\Features\Blog\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Src\Features\Blog\Domain\Services\BlogService;

class BlogController extends Controller
{
   private BlogService $blogService;

    /**
     * @param BlogService $blogService
     */
    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }


    public function index()
    {
        return $this->blogService->index()->response();
    }

}
