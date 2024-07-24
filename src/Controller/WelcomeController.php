<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class WelcomeController extends AbstractController
{
    #[Route('/welcome/{userName}', name: 'welcome_page')]

    public function welcome(string $userName): Response
    {
        return $this->render('welcome_controller/index.html.twig', [
            'userName' => $userName,
        ]);
    }
}
