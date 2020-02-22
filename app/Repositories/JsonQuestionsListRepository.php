<?php

namespace App\Repositories;

use App\Interfaces\QuestionsListRepositoryInterface;
use App\Models\Question;
use App\Models\QuestionsList;
use Illuminate\Support\Facades\Log;

class JsonQuestionsListRepository implements QuestionsListRepositoryInterface
{
    const FILE_PATH = __DIR__ . '/../../storage/app/questions.json';

    /**
     * @return QuestionsList
     */
    public function getAll(): QuestionsList
    {
        $jsonQuestionsList = file_get_contents(self::FILE_PATH);
        $arrayQuestionsList = json_decode($jsonQuestionsList, 1);

        return QuestionsList::fromArray($arrayQuestionsList);
    }

    /**
     * @param Question $question
     *
     * @return Question|null
     */
    public function save(Question $question): ?Question
    {
        try {
            $currentQuestionsList = $this->getAll();
            $currentQuestionsList->addQuestion($question);
            $newJsonQuestionsList = json_encode($currentQuestionsList->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            file_put_contents(self::FILE_PATH, $newJsonQuestionsList, LOCK_EX);
            return $question;
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage(). PHP_EOL. $exception->getTraceAsString());
            return null;
        }
    }
}