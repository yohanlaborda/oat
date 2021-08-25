<?php

namespace OAT\Question\Domain\ValueObject;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Stringable;

final class Id implements Stringable
{
    private function __construct(private UuidInterface $uuid)
    {
    }

    public static function create(UuidInterface $uuid): self
    {
        return new self($uuid);
    }

    public static function createNew(): self
    {
        return new self(
            Uuid::uuid4()
        );
    }

    public static function createFromString(string $uuid): self
    {
        return self::create(
            Uuid::fromString($uuid)
        );
    }

    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {
        return (string) $this->uuid;
    }
}
