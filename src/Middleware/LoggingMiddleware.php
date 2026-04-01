<?php

namespace App\Middleware;

use App\Stamp\LoggingStamp;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;

final class LoggingMiddleware implements MiddlewareInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
    ) {}

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        if (null === $envelope->last(LoggingStamp::class)) {
            $envelope = $envelope->with(new LoggingStamp());

            $this->logger->info(sprintf("New message : %s", serialize($envelope->getMessage())));
        }

        return $stack->next()->handle($envelope, $stack);
    }
}
