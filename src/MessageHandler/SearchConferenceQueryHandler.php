<?php

namespace App\MessageHandler;

use App\Message\SearchConferenceQuery;
use App\Search\ConferenceSearchInterface;
use App\Search\DatabaseConferenceSearch;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class SearchConferenceQueryHandler
{
    public function __construct(
        private readonly ConferenceSearchInterface $apiSearch,
        private readonly DatabaseConferenceSearch $dbSearch,
    )
    {
    }

    public function __invoke(SearchConferenceQuery $message): iterable
    {
        $conferences = $this->dbSearch->search($message->name);

        if ([] === $conferences) {
            $conferences = $this->apiSearch->search($message->name);
        }

        return $conferences;
    }
}
