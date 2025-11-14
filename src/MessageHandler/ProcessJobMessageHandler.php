<?php

namespace App\MessageHandler;

use App\Message\ProcessJobMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class ProcessJobMessageHandler
{
    public function __invoke(ProcessJobMessage $message): void
    {
    }
}
