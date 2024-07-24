<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'register_page')]
    public function register(Request $request, EntityManagerInterface $entityManager): Response
    {
        $error = null;
        if ($request->isMethod('POST')) {
            $name = $request->request->get('name');
            $userName = $request->request->get('userName');
            $password = $request->request->get('password');
            $userRepository = $entityManager->getRepository(User::class);
            $user = $userRepository->findOneBy(['name' => $name]);
            if (!(empty($name) || empty($password) || empty($userName))) {
                if (!$user) {
                    $user = new User();
                    $user->setName($name);
                    $user->setUserName($userName);
                    $user->setPassword($password);
                    $user->setLoginCount(0);
                    $entityManager->persist($user);
                    $entityManager->flush();
                    return $this->redirectToRoute('user_page');
                } else {
                    $error = "User already Exist";
                }
            } else {
                $error = "Name and Password are Required.";
            }
        }
        return $this->render('register_controller/index.html.twig', [
            'controller_name' => 'RegisterController',
            'error' => $error
        ]);
    }
}
