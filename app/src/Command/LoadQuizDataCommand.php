<?php

namespace App\Command;

use App\Entity\Question;
use App\Repository\QuestionRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'app:load-quiz-data',
    description: 'Генерация вопросов для теста',
)]
class LoadQuizDataCommand extends Command
{
    public function __construct(
        private readonly QuestionRepository $questionRepository
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $data = [
            [
                "text" => "1 + 1",
                "answers" => [
                    ['id' => 1, 'text' => "3"],
                    ['id' => 2, 'text' => "2"],
                    ['id' => 3, 'text' => "0"],
                ],
                "correctAnswers" => [2]
            ],
            [
                "text" => "2 + 2",
                "answers" => [
                    ['id' => 1, 'text' => "4"],
                    ['id' => 2, 'text' => "3 + 1"],
                    ['id' => 3, 'text' => "10"],
                ],
                "correctAnswers" => [1, 2]
            ],
            [
                "text" => "3 + 3",
                "answers" => [
                    ['id' => 1, 'text' => "1 + 5"],
                    ['id' => 2, 'text' => "1"],
                    ['id' => 3, 'text' => "6"],
                    ['id' => 4, 'text' => "2 + 4"],
                ],
                "correctAnswers" => [1, 3, 4]
            ],
            [
                "text" => "4 + 4",
                "answers" => [
                    ['id' => 1, 'text' => "8"],
                    ['id' => 2, 'text' => "4"],
                    ['id' => 3, 'text' => "0"],
                    ['id' => 4, 'text' => "0 + 8"],
                ],
                "correctAnswers" => [1, 4]
            ],
            [
                "text" => "5 + 5",
                "answers" => [
                    ['id' => 1, 'text' => "6"],
                    ['id' => 2, 'text' => "18"],
                    ['id' => 3, 'text' => "10"],
                    ['id' => 4, 'text' => "9"],
                    ['id' => 5, 'text' => "0"],
                ],
                "correctAnswers" => [3]
            ],
            [
                "text" => "6 + 6",
                "answers" => [
                    ['id' => 1, 'text' => "3"],
                    ['id' => 2, 'text' => "9"],
                    ['id' => 3, 'text' => "0"],
                    ['id' => 4, 'text' => "12"],
                    ['id' => 5, 'text' => "5 + 7"],
                ],
                "correctAnswers" => [4, 5]
            ],
            [
                "text" => "7 + 7",
                "answers" => [
                    ['id' => 1, 'text' => "5"],
                    ['id' => 2, 'text' => "14"],
                ],
                "correctAnswers" => [2]
            ],
            [
                "text" => "8 + 8",
                "answers" => [
                    ['id' => 1, 'text' => "16"],
                    ['id' => 2, 'text' => "12"],
                    ['id' => 3, 'text' => "9"],
                    ['id' => 4, 'text' => "5"],
                ],
                "correctAnswers" => [1]
            ],
            [
                "text" => "9 + 9",
                "answers" => [
                    ['id' => 1, 'text' => "18"],
                    ['id' => 2, 'text' => "9"],
                    ['id' => 3, 'text' => "17 + 1"],
                    ['id' => 4, 'text' => "2 + 16"],
                ],
                "correctAnswers" => [1, 3, 4]
            ],
            [
                "text" => "10 + 10",
                "answers" => [
                    ['id' => 1, 'text' => "0"],
                    ['id' => 2, 'text' => "2"],
                    ['id' => 3, 'text' => "8"],
                    ['id' => 4, 'text' => "20"],
                ],
                "correctAnswers" => [4]
            ],
        ];

        foreach ($data as $item) {
            $question = new Question();
            $question->setText($item['text']);
            $question->setAnswers($item['answers']);
            $question->setCorrectAnswers($item['correctAnswers']);

            $this->questionRepository->save($question);
        }

        $this->questionRepository->flush();

        $io->success('Вопросы были успешно загружены');

        return Command::SUCCESS;
    }
}
