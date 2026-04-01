<?php

namespace App\Message;

final class MatchVolunteerMessage
{
    public function __construct(
        public readonly int $userId,
        public readonly int $priority = 0,
    ) {}
}
