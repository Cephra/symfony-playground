<?php

namespace App\Message;

use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage('async')]
final class ProcessJobMessage
{
    public function __construct(
        public readonly int $jobId,
    ) {
    }

    public function getJobId(): int
    {
        return $this->jobId;
    }
}
