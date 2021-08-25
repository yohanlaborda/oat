<?php

namespace OAT\Question\Domain\Service;

use OAT\Question\Domain\Collection\Choices;
use OAT\Question\Domain\Entity\Question;
use OAT\Question\Domain\Factory\QuestionFactory;
use OAT\Question\Domain\Translate\TranslateService;
use OAT\Question\Domain\ValueObject\Choice;
use OAT\Question\Domain\ValueObject\Text;

final class TranslateQuestionService
{
    public function __construct(private TranslateService $translateService)
    {
    }

    public function translate(Question $question, string $lang): Question
    {
        $text = $this->translateService->translate($question->text()->value(), $lang);
        $choices = $this->translateChoices($question, $lang);

        return QuestionFactory::create(
            id: $question->id(),
            text: Text::create($text ?? $question->text()->value()),
            createdAt: $question->createdAt(),
            choices: $choices ?? $question->choices()
        );
    }

    private function translateChoices(Question $question, string $lang): Choices
    {
        $allChoices = $question->choices()->getAll();

        $choices = new Choices();
        foreach ($allChoices as $choice) {
            $choiceText = $choice->text()->value();
            $text = $this->translateService->translate($choiceText, $lang);
            $choices->add(
                Choice::createFromString($text ?? $choiceText)
            );
        }

        return $choices;
    }
}
