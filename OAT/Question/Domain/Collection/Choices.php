<?php

namespace OAT\Question\Domain\Collection;

use OAT\Question\Domain\ValueObject\Choice;

final class Choices
{
    /**
     * @var Choice[]
     */
    private array $choices = [];

    public function __construct(Choice ...$choices)
    {
        foreach ($choices as $choice) {
            $this->add($choice);
        }
    }

    /**
     * @param string[] $choices
     */
    public static function createFromArray(array $choices): self
    {
        return new self(
            ...array_map(
                static fn (string $choice) => Choice::createFromString($choice),
                $choices
            )
        );
    }

    public static function createNew(): self
    {
        return new self();
    }

    public function add(Choice $choice): void
    {
        $this->choices[] = $choice;
    }

    /**
     * @return Choice[]
     */
    public function getAll(): array
    {
        return $this->choices;
    }

    /**
     * @return string[]
     */
    public function toArray(): array
    {
        if (0 === count($this->choices)) {
            return [];
        }

        return array_map(
            static fn (Choice $choice) => (string) $choice,
            $this->choices
        );
    }
}
