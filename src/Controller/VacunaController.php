<?php

namespace App\Controller;

use App\Form\PatologiaFormType;
use App\Entity\Vacunas;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;


class VacunaController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/vacunas', name: 'app_vacunas')]
    public function vacunas(): Response
    {
      $vacunas = $this->entityManager->getRepository(Vacunas::class)->findAll();
      $data = [];
      foreach ($vacunas as $vacuna) {
          $data[] = [
              'id' => $vacuna->getId(),
              'nombre' => $vacuna->getNombre(),
          ];
      }
      return new JsonResponse($data, Response::HTTP_OK);
    }   
}
