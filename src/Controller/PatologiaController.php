<?php

namespace App\Controller;

use App\Form\PatologiaFormType;
use App\Entity\Patologia;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class PatologiaController extends AbstractController
{
        private $entityManager;
    
        public function __construct(EntityManagerInterface $entityManager)
        {
            $this->entityManager = $entityManager;
        }

    #[Route('/patologia', name: 'app_patologia')]
    public function index(Request $request): Response
    {
        $patologia = new Patologia(); 
        $form = $this->createForm(PatologiaFormType::class, $patologia); //Crea el formulario y lo vincula a la entidad que corresponde

        $form->handleRequest($request); 

        if($form->isSubmitted() && $form->isValid()){
            $patologia->setIsPandemia(false);
            $patologia->setPandemia(NULL);
            $this->entityManager->persist($patologia);
            $this->entityManager->flush();
            $this->addFlash('exito','OK');
            return $this->redirectToRoute('app_patologia');

            /*
            $patologia->setIsPandemia(false);
            $patologia->setNombre("FLOR");
            $patologia->setPandemia('null')
            $this->entityManager->persist($patologia);
            $this->entityManager->flush();
            
            return*/
        }
        
        

        return $this->render('patologia/index.html.twig', [
            'controller_name' => 'PatologiaController',
            'formulario'=> $form->createView(),
        ]);
    }
}
