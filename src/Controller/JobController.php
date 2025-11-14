<?php

namespace App\Controller;

use App\Entity\Job;
use App\Message\ProcessJobMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

final class JobController extends AbstractController
{
    #[Route('/job', name: 'app_job_create', methods: ['POST'])]
    public function create(
        Request $request,
        EntityManagerInterface $em,
        MessageBusInterface $bus,
    ) {
        $job = new Job();

        $em->persist($job);
        $em->flush();

        $bus->dispatch(new ProcessJobMessage($job->getId()));

        return $this->json([
            'id' => $job->getId(),
            'status' => $job->getStatus(),
        ], 202);
    }
}
