<?php

namespace App\Controller;

use App\Form\PatologiaFormType;
use App\Entity\Patologia;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatologiaController extends AbstractController
{
    #[Route('/patologia', name: 'app_patologia')]
    public function index(): Response
    {
        $patologia = new Patologia();
        $form = $this->createForm(PatologiaFormType::class, $patologia);

        return $this->render('patologia/index.html.twig', [
            'controller_name' => 'PatologiaController',
            'formulario'=> $form->createView(),
        ]);
    }
}
