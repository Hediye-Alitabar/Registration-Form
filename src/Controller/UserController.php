<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{
    #[Route('/', name: 'user_page')]

    public function register(Request $request, EntityManagerInterface $entityManager): Response
    {
        return $this->render('user_controller/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
