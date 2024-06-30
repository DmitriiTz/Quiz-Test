<?php

namespace App\Controller;

use App\Service\QuizService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(name: 'quiz')]
class QuizController extends AbstractController
{
    public function __construct(
        private readonly QuizService $quizService,
    )
    {
    }

    #[Route('/', name: '.index', methods: ["GET"])]
    public function index(): Response
    {
        $questions = $this->quizService->getAllQuestions();

        return $this->render('quiz/index.html.twig', ['questions' => $questions]);
    }

    #[Route('/submit', name: '.submit', methods: ["POST"])]
    public function submit(Request $request): Response
    {
        $userId = uniqid();
        $answers = $request->request->all()['answers'] ?? [];

        $this->quizService->saveAnswers(userId: $userId, answers: $answers);

        return $this->redirectToRoute('quiz.result', ['userId' => $userId]);
    }

    #[Route('/result/{userId}', name: '.result', methods: ["GET"])]
    public function result(?string $userId): Response
    {
        if ($userId === null) {
            return $this->redirectToRoute('quiz.index');
        }

        $results = $this->quizService->getResults(userId: $userId);

        return $this->render('quiz/results.html.twig', $results);
    }
}