<?php

declare(strict_types=1);

namespace App\Webhook\Handler;

use App\DTO\Webhook;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

readonly class HandlerDelegator
{
    /**
     * @param iterable<WebhookHandlerInterface> $handlers
     */
    public function __construct(
        #[AutowireIterator('webhook.handler')] private iterable $handlers,
    ) {
    }

    public function delegate(Webhook $webhook): void
    {
        // loop over the handlers
        foreach ($this->handlers as $handler) {
            // ask if supports event
            if ($handler->supports($webhook)) {
                // if supported call handle
                $handler->handle($webhook);
            }
        }
    }
}
