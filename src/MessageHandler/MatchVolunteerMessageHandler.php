<?php

namespace App\MessageHandler;

use App\Matching\Strategy\TagBasedStrategy;
use App\Message\MatchVolunteerMessage;
use App\Repository\UserRepository;
use App\Repository\VolunteerProfileRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class MatchVolunteerMessageHandler
{
    public function __construct(
        private readonly TagBasedStrategy $strategy,
        private readonly UserRepository $repository,
    ) {}

    public function __invoke(MatchVolunteerMessage $message): void
    {
        $user = $this->repository->find($message->userId);

        $matches = $this->strategy->match($user);
        dump($matches);
    }
}
