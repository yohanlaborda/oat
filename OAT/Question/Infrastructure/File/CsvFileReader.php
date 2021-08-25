<?php

namespace OAT\Question\Infrastructure\File;

use OAT\Question\Domain\Collection\Choices;
use OAT\Question\Domain\Entity\Question;
use OAT\Question\Domain\Factory\QuestionFactory;
use OAT\Question\Domain\File\FileReader;
use OAT\Question\Domain\ValueObject\Choice;
use OAT\Question\Domain\ValueObject\CreatedAt;
use OAT\Question\Domain\ValueObject\Id;
use OAT\Question\Domain\ValueObject\Text;

final class CsvFileReader implements FileReader
{
    private const POSITION_TEXT = 0;
    private const POSITION_CREATED_AT = 1;
    private const POSITION_CHOICES = 2;

    /**
     * {@inheritDoc}
     */
    public function read(string $path): array
    {
        $fileResource = fopen($path, 'r');
        if (false === $fileResource) {
            return [];
        }

        $data = $this->getData($fileResource);

        /** @var Question[] $questions */
        $questions = [];
        foreach ($data as $question) {
            $questions[] = $this->create($question);
        }

        fclose($fileResource);

        return $questions;
    }

    /**
     * @return mixed[]
     */
    private function getData(mixed $fileResource): array
    {
        $data = [];
        while (false !== ($fileData = fgetcsv($fileResource, 1000, ','))) {
            $data[] = $fileData;
        }

        if (count($data) > 1) {
            array_shift($data);
        }

        return $data;
    }

    /**
     * @param mixed[] $fileData
     */
    private function create(array $fileData): Question
    {
        $text = isset($fileData[self::POSITION_TEXT]) ? (string) $fileData[self::POSITION_TEXT] : '';
        $createdAt = isset($fileData[self::POSITION_CREATED_AT]) ? (string) $fileData[self::POSITION_CREATED_AT] : '';
        $choices = Choices::createNew();

        return QuestionFactory::create(
            Id::createNew(),
            Text::create($text),
            CreatedAt::createFromStringFormat($createdAt),
            $this->addChoices($choices, $fileData, self::POSITION_CHOICES)
        );
    }

    /**
     * @param mixed[] $fileData
     */
    private function addChoices(Choices $choices, array $fileData, int $positionChoice): Choices
    {
        $choiceFound = isset($fileData[$positionChoice]) ? (string) $fileData[$positionChoice] : null;
        if (empty($choiceFound)) {
            return $choices;
        }

        $choices->add(Choice::createFromString($choiceFound));
        ++$positionChoice;

        return $this->addChoices($choices, $fileData, $positionChoice);
    }
}
