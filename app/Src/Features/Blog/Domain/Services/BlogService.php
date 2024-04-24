<?php

namespace Src\Features\Blog\Domain\Services;

use Src\Base\Response\DataStatus;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Blog\Core\Resources\BlogResource;
use Src\Features\Blog\Data\Repositories\BlogRepository;

class BlogService extends ServiceImp
{
   private BlogRepository $blogRepository;

    /**
     * @param BlogRepository $blogRepository
     */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index(int $paginate = 0):DataStatus
    {
        $blogs = $this->blogRepository->index(paginate:$paginate);
        if($blogs){
           return  new DataSuccess(
               data:$blogs,
               resourceData: BlogResource::collection($blogs),
               message: 'تم ارجاع البلوج بنجاح'
           );
        }
    }


}
