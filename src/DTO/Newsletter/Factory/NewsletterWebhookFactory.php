<?php

declare(strict_types=1);

namespace App\DTO\Newsletter\Factory;

use App\DTO\Newsletter\NewsletterWebhook;
use App\DTO\Webhook;
use App\Error\Exception\WebhookException;
use Symfony\Component\Serializer\SerializerInterface;

class NewsletterWebhookFactory
{
    public function __construct(
        private SerializerInterface $serializer,
    ) {
    }

    public function create(Webhook $webhook): NewsletterWebhook
    {
        try {
            $newsletterWebhook = $this->serializer->deserialize(
                $webhook->getRawPayload(),
                NewsletterWebhook::class,
                'json'
            );
            return $newsletterWebhook;
        } catch (\Throwable $exception) {
            throw new WebhookException(
                message: 'Unable to create newsletter webhook because of: ' . $exception->getMessage(),
            );
        }
    }
}
