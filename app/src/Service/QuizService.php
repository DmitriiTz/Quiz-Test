<?php

namespace App\Service;

use App\Entity\Question;
use App\Entity\QuizResult;
use App\Repository\QuestionRepository;
use App\Repository\QuizResultRepository;

class QuizService
{
    const QUESTIONS_PER_PAGE = 10;

    public function __construct(
        private readonly QuestionRepository   $questionRepository,
        private readonly QuizResultRepository $quizResultRepository,
    )
    {
    }

    public function getAllQuestions(): array
    {
        return $this->questionRepository->getAll(limit: $this::QUESTIONS_PER_PAGE);
    }

    public function saveAnswers(string $userId, array $answers): void
    {
        $questions = $this->questionRepository->getAll($this::QUESTIONS_PER_PAGE);

        /** @var Question $question */
        foreach ($questions as $question) {
            $result = new QuizResult();
            $result->setUserId(userId: $userId);
            $result->setQuestion(question: $question);

            $questionId = $question->getId();
            $result->setAnswers(answers: $answers[$questionId] ?? []);

            $isCorrect = $this->isCorrect(question: $question, answers: $answers);

            $result->setIsCorrect(isCorrect: $isCorrect);
            $this->quizResultRepository->save(quizResult: $result);
        }
        $this->quizResultRepository->flush();
    }

    private function isCorrect(Question $question, array $answers): bool
    {
        $questionId = $question->getId();
        $correctAnswers = $question->getCorrectAnswers();
        if (!key_exists($questionId, $answers)) {
            return false;
        } else {
            foreach ($answers[$questionId] as $answer) {
                if (!in_array((int)$answer, $correctAnswers)) {
                    return false;
                }
            }
        }
        return true;
    }

    public function getResults(string $userId): array
    {
        $questions = $this->questionRepository->getAll(limit: $this::QUESTIONS_PER_PAGE);
        $userResults = $this->quizResultRepository->getByUserId(userId: $userId);

        $formattedResults = $this->formatResults(userResults: $userResults);

        return [
            'questions' => $questions,
            'results' => $formattedResults,
        ];
    }

    private function formatResults(array $userResults): array
    {
        $formattedResults = [];
        /** @var QuizResult $result */
        foreach ($userResults as $result) {
            $formattedResults[$result->getQuestion()->getId()] = [
                'isCorrect' => $result->isCorrect(),
                'correctAnswers' => $result->getQuestion()->getCorrectAnswers(),
                'userAnswers' => $result->getAnswers()
            ];
        }

        return $formattedResults;
    }
}