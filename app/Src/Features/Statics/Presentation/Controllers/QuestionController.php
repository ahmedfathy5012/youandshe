<?php

namespace App\Src\Features\Statics\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Src\Features\Statics\Domain\Services\QuestionService;

class QuestionController extends  Controller
{
   private QuestionService $questionService;

    /**
     * @param QuestionService $questionService
     */
    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }


    public function index()
    {
       return $this->questionService->index()->response();
    }

}
