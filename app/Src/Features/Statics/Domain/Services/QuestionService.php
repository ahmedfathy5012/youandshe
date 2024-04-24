<?php

namespace Src\Features\Statics\Domain\Services;

use Src\Base\Response\DataFailed;
use Src\Base\Response\DataSuccess;
use Src\Base\Service\ServiceImp;
use Src\Features\Statics\Core\Resources\QuestionResource;
use Src\Features\Statics\Data\Repositories\QuestionRepository;

class QuestionService extends ServiceImp
{
    private QuestionRepository $questionRepository;

    /**
     * @param QuestionRepository $questionRepository
     */
    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function index()
    {
        $questions = $this->questionRepository->index();
        if($questions){
            return new DataSuccess(data:$questions,resourceData: QuestionResource::collection($questions),message: 'تم ارجاع الاسئلة');
        }else{
            return new DataFailed(message: 'حدث خطآ ما اثناء ارجاع الاسئلة');
        }
    }


}
