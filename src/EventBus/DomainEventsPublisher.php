<?php

namespace MR\DoctrineDomainEventsBundle\EventBus;

use SimpleBus\Message\Recorder\ContainsRecordedMessages;
use SimpleBus\Message\Bus\MessageBus;

class DomainEventsPublisher
{
    private $eventBus;

    private $recordedMessages;

    public function __construct(MessageBus $eventBus, ContainsRecordedMessages $recordedMessages)
    {
        $this->eventBus = $eventBus;
        $this->recordedMessages = $recordedMessages;
    }

    public function publishEvents()
    {
        $messages = $this->recordedMessages->recordedMessages();

        foreach ($messages as $message) {
            $this->eventBus->handle($message);
        }
    }
}