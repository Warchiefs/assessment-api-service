<?php

return [

    'questions_list_repository' => env('QUESTIONS_LIST_REPOSITORY', 'json'),

    'questions_list_repositories_mapping' => [
        'json' =>  \App\Repositories\JsonQuestionsListRepository::class,
        'csv' => \App\Repositories\CsvQuestionsListRepository::class,
    ],
];