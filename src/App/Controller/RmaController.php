<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
class RmaController extends ResourceController
{
    public function indexAction(Request  $request) : Response
    {
        return parent::indexAction($request);
    }
}
