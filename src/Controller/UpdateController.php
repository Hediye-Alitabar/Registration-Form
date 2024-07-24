<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class UpdateController extends AbstractController
{
    #[Route('/update', name: 'update_page')]
    public function update(Request $request, EntityManagerInterface $entityManager): Response
    {
        $error = null;
        
        if ($request->isMethod('POST')) {
            $name = $request->request->get('name');
            $currentName = $request->request->get('currentName');
            $userName = $request->request->get('userName');
            $password = $request->request->get('password');
            $userRepository = $entityManager->getRepository(User::class);
            $user = $userRepository->findOneBy(['name' => $currentName]);
            
            if ($user) {
                if (empty($name) || empty($password)) {
                    $error = "Name and Password are required.";
                } else {
                    $user->setName($name);
                    $user->setUserName($userName);
                    $user->setPassword($password);
                    $entityManager->persist($user);
                    $entityManager->flush();
                    return $this->redirectToRoute('login_page');
                }
            } else {
                $error = "This user was not found!";
            }
        }
        return $this->render('update_controller/index.html.twig', [
            'controller_name' => 'UpdateController',
            'error' => $error
        ]);
    }
}
