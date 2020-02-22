<?php

namespace App\Repositories;

use App\Helpers\CsvHelper;
use App\Interfaces\QuestionsListRepositoryInterface;
use App\Models\QuestionsList;
use App\Models\Question;
use Illuminate\Support\Facades\Log;

class CsvQuestionsListRepository implements QuestionsListRepositoryInterface
{
    const FILE_PATH = __DIR__ . '/../../storage/app/questions.csv';

    /**
     * @return QuestionsList
     */
    public function getAll(): QuestionsList
    {
        $csvContent = array_map('str_getcsv', file(self::FILE_PATH));
        unset($csvContent[0]);

        $questions = [];

        foreach ($csvContent as $csvRow) {
            $question = [];
            $question['text'] = $csvRow[0];
            $question['createdAt'] = $csvRow[1];
            $question['choices'] = [];
            unset($csvRow[0], $csvRow[1]);
            foreach ($csvRow as $choiceText) {
                $question['choices'][] = ['text' => $choiceText];
            }

            $questions[] = $question;
            unset($question);
        }

        return QuestionsList::fromArray($questions);
    }

    /**
     * @param Question $question
     *
     * @return Question|null
     */
    public function save(Question $question): ?Question
    {
        try {
            $questionForCsv = [];
            $questionForCsv[] = $question->text;
            $questionForCsv[] = $question->createdAt;
            foreach ($question->choices as $choice) {
                $questionForCsv[] = $choice->text;
            }

            $csvFileStream = fopen(self::FILE_PATH, 'a');
            CsvHelper::fputcsv($csvFileStream, $questionForCsv);
            fclose($csvFileStream);
            return $question;
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage(). PHP_EOL. $exception->getTraceAsString());
            return null;
        }
    }
}