<?php

namespace OAT\Question\Domain\ValueObject;

use DateTimeImmutable;
use DateTimeInterface;
use InvalidArgumentException;

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

    public static function createFromStringFormat(string $dateTime): self
    {
        $dateTimeFromFormat = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $dateTime);
        if (false === $dateTimeFromFormat) {
            throw new InvalidArgumentException('Incorrectly formatted date.');
        }

        return new self($dateTimeFromFormat);
    }

    public function value(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
