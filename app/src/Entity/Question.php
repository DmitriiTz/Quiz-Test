<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: false)]
    private string $text;

    #[ORM\Column(type: Types::JSON, length: 5, nullable: false)]
    private array $answers;

    #[ORM\Column(type: Types::JSON, nullable: false)]
    private array $correctAnswers;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getAnswers(): array
    {
        return $this->answers;
    }

    public function setAnswers(array $answers): void
    {
        $this->answers = $answers;
    }

    public function getCorrectAnswers(): array
    {
        return $this->correctAnswers;
    }

    public function setCorrectAnswers(array $correctAnswers): void
    {
        $this->correctAnswers = $correctAnswers;
    }
}
