<?php

namespace OAT\Question\Domain\ValueObject;

use DateTimeImmutable;
use DateTimeInterface;

final class CreatedAt
{
    private function __construct(private DateTimeImmutable $createdAt)
    {
    }

    public static function create(DateTimeImmutable $createdAt): self
    {
        return new self($createdAt);
    }

    public static function createFromDateTime(DateTimeInterface $dateTime): self
    {
        return new self(
            DateTimeImmutable::createFromInterface($dateTime)
        );
    }

    public function value(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
