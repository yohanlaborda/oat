<?php

namespace OAT\Question\Application\Request;

use DateTimeImmutable;

final class CreateQuestionRequest
{
    /**
     * @param string[] $choices
     */
    public function __construct(
        private string $text,
        private DateTimeImmutable $createdAt,
        private array $choices
    ) {
    }

    /**
     * @param mixed[] $data
     */
    public static function createFromArray(array $data): self
    {
        $createdAt = isset($data['createdAt']) ? DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $data['createdAt']) : new DateTimeImmutable();
        $choices = isset($data['choices']) ? (array) $data['choices'] : [];
        $newChoices = [];
        foreach ($choices as $choice) {
            $choiceText = isset($choice['text']) ? $choice['text'] : null;
            if ($choiceText) {
                $newChoices[] = $choiceText;
            }
        }

        return new self(
            text: isset($data['text']) ? (string) $data['text'] : '',
            createdAt: false !== $createdAt ? $createdAt : new DateTimeImmutable(),
            choices: $newChoices
        );
    }

    public function text(): string
    {
        return $this->text;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return string[]
     */
    public function choices(): array
    {
        return $this->choices;
    }
}
