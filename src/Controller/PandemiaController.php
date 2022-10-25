<?php

namespace App\Controller;

use App\Form\PandemiaFormType;
use App\Entity\Pandemia;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PandemiaController extends AbstractController
{
    #[Route('/pandemia', name: 'app_pandemia')]
    public function index(): Response
    {
        $pandemia = new Pandemia();
        $form = $this->createForm(PandemiaFormType::class, $pandemia);


        return $this->render('pandemia/index.html.twig', [
            'controller_name' => 'PandemiaController',
            'formulario'=> $form->createView(),
        ]);
    }
}
