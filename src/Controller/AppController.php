<?php

namespace App\Controller;

use App\Repository\OknaRepository;
use App\Services\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    public function index(OknaRepository $okna)
    {
        $okna = $okna->findAll();
        
        $view = [];
        for ($i = 0; $i < count($okna); $i++) {
            $view[$okna[$i]->getYPos()][$okna[$i]->getXPos()] = array(
                'id' => $okna[$i]->getId(),
                'name' => $okna[$i]->getName()
            );
        }

        return $this->render('app/index.html.twig', compact('view'));
    }
    
    public function token(JWT $jwt)
    {
        $canControl = $this->isGranted('ROLE_CONTROL');
        $token = $jwt->getToken($canControl);
        return $this->json([
            'success' => true,
            'canControl' => $canControl,
            'socketServer' => $this->getParameter('socketServer'),
            'token' => $token
        ]);
    }
}
