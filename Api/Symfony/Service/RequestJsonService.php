<?php

namespace Api\Symfony\Service;

use Symfony\Component\HttpFoundation\Request;

final class RequestJsonService
{
    /**
     * @return mixed[]
     */
    public function requestToArray(Request $request): array
    {
        return json_decode((string) $request->getContent(), true, 512, JSON_THROW_ON_ERROR) ?? [];
    }
}
