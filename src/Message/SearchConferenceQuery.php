<?php

namespace App\Message;

use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage('sync')]
final class SearchConferenceQuery
{
    public function __construct(
        public readonly string $name,
    ) {}
}
