<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function index()
    {
        //return $this->redirect($this->generateUrl('app_login'));
        return $this->redirectToRoute('app_login');
    }
}
