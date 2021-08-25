<?php

declare(strict_types=1);

namespace OAT\Question\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use OAT\Question\Domain\ValueObject\Id;

final class DoctrineQuestionIdType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof Id ? (string) $value : null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Id
    {
        return is_string($value) ? Id::createFromString($value) : null;
    }

    public function getName(): string
    {
        return 'oat_question_id';
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
