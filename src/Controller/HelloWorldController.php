<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController extends AbstractController
{
    #[Route('/hello-world', name: 'hello_world', methods: ['GET'])]
    public function index()
    {
        return $this->json([
            'message' => 'Hello World!',
        ]);
    }
}
