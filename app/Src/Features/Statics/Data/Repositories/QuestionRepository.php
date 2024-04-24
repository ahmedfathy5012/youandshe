<?php

namespace Src\Features\Statics\Data\Repositories;

use Src\Base\Repositories\Repository;
use Src\Features\Statics\Data\Models\Question;

class QuestionRepository extends Repository
{

    public function __construct(Question $question)
    {
        $this->setModel($question);
    }

}
