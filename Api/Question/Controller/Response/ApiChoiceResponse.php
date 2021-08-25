<?php

namespace Api\Question\Controller\Response;

use JsonSerializable;
use OAT\Question\Application\Response\ChoiceResponse;

final class ApiChoiceResponse implements JsonSerializable
{
    public function __construct(private ChoiceResponse $choice)
    {
    }

    public function jsonSerialize()
    {
        return [
            'text' => $this->choice->text(),
        ];
    }
}
