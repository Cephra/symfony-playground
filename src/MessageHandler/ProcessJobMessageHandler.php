<?php

namespace App\MessageHandler;

use App\Entity\Job;
use App\Message\ProcessJobMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\Exception\UnrecoverableMessageHandlingException;

#[AsMessageHandler]
final class ProcessJobMessageHandler
{
    public function __construct(
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function __invoke(ProcessJobMessage $message): void
    {
        $jobId = $message->getJobId();
        /** @var Job|null */
        $job = $this->em->getRepository(Job::class)->find($jobId);

        if (!$job) {
            throw new UnrecoverableMessageHandlingException(sprintf('Could not find job with id %d', $jobId));
        }
        
        $job->setStatus(Job::STATUS_DONE);
        $this->em->flush();
        
        dump(sprintf('processing job %d', $jobId));
    }
}
