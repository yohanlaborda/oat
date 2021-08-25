<?php

declare(strict_types=1);

namespace OAT\Question\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonType;
use OAT\Question\Domain\Collection\Choices;

final class DoctrineQuestionChoicesType extends JsonType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof Choices ? parent::convertToDatabaseValue($value->toArray(), $platform) : null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Choices
    {
        $phpValue = parent::convertToPHPValue($value, $platform);

        return is_array($phpValue) ? Choices::createFromArray($phpValue) : null;
    }

    public function getName(): string
    {
        return 'oat_question_text';
    }
}
