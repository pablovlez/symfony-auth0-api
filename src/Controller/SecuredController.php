<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SecuredController extends AbstractController
{
    /**
     * @Route("/secured", name="secured")
     */
    public function index()
    {
        return $this->render('secured/index.html.twig', [
            'controller_name' => 'SecuredController',
        ]);
    }

    /**
     * @Route("/api/public", name="public")
     * @return JsonResponse
     */
    public function publicAction(){
        $data = [
            'albumId' => '1',
            'id' => 1,
            'title' => 'titulo de prueba',
            'description' => 'prueba de metodo publico'
        ];

        return new JsonResponse($data);
    }

    /**
     * @Route("/api/private", name="private")
     * @return JsonResponse
     */
    public function privateAction(){
        $data = [
            'albumId' => '1',
            'id' => 1,
            'title' => 'titulo de prueba',
            'description' => 'prueba de metodo privado'
        ];

        return new JsonResponse($data);
    }
}
