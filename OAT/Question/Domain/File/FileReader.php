<?php

namespace OAT\Question\Domain\File;

use OAT\Question\Domain\Entity\Question;

interface FileReader
{
    /**
     * @return Question[]
     */
    public function read(string $path): array;
}
