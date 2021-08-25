<?php

declare(strict_types=1);

namespace OAT\Question\Infrastructure\Persistence\Doctrine\Type;

use DateTimeInterface;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateTimeType;
use OAT\Question\Domain\ValueObject\CreatedAt;

final class DoctrineQuestionCreatedAtType extends DateTimeType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof CreatedAt ? parent::convertToDatabaseValue($value->value(), $platform) : null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?CreatedAt
    {
        $phpValue = parent::convertToPHPValue($value, $platform);

        return $phpValue instanceof DateTimeInterface ? CreatedAt::createFromDateTime($phpValue) : null;
    }

    public function getName(): string
    {
        return 'oat_question_created_at';
    }
}
