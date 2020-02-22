<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestionsRequest;
use App\Http\Requests\IndexQuestionsRequest;
use App\Interfaces\QuestionsListRepositoryInterface;
use App\Models\Question;
use Symfony\Component\HttpFoundation\Response;

class QuestionsController extends Controller
{
    /**
     * @var QuestionsListRepositoryInterface
     */
    private $repository;

    /**
     * QuestionsController constructor.
     *
     * @param QuestionsListRepositoryInterface $repository
     */
    public function __construct(QuestionsListRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param IndexQuestionsRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(IndexQuestionsRequest $request)
    {
        $language = $request->get('lang', config('translation.source_language'));
        $questionsList = $this->repository->getAll();
        $questionsList = $questionsList->translate($language);
        return response()->json($questionsList);
    }

    /**
     * @param CreateQuestionsRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateQuestionsRequest $request)
    {
        $questionData = $request->all();

        $question = Question::fromArray($questionData);
        $savedQuestion = $this->repository->save($question);
        if ($savedQuestion) {
            return response()->json($savedQuestion);
        }

        return response()->json(['error' => 'Creating problems'], Response::HTTP_BAD_REQUEST);

    }
}
