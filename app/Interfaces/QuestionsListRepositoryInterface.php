<?php

namespace App\Interfaces;

use App\Models\Question;
use App\Models\QuestionsList;

interface QuestionsListRepositoryInterface
{
    /**
     * @return QuestionsList
     */
    public function getAll(): QuestionsList;


    /**
     * @param Question $question
     *
     * @return Question|null
     */
    public function save(Question $question): ?Question;
}