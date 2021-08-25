<?php

declare(strict_types=1);

namespace OAT\Question\Infrastructure\Persistence\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use OAT\Question\Domain\ValueObject\Text;

final class DoctrineQuestionTextType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof Text ? $value->value() : null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Text
    {
        return is_string($value) ? Text::create($value) : null;
    }

    public function getName(): string
    {
        return 'oat_question_text';
    }
}
