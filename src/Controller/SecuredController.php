<?php

/**
 * This file contains the SecuredController class for handling public and private API endpoints.
 *
 * @package App\Controller
 * @author  Symfony Auth0 API
 * @since   1.0.0
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Secured controller for handling API endpoints with different access levels.
 *
 * This controller provides both public and private API endpoints that return
 * sample data. The private endpoint requires authentication while the public
 * endpoint is accessible to all users.
 *
 * @package App\Controller
 */
class SecuredController extends AbstractController
{
    /**
     * Public API endpoint that returns sample data without authentication.
     *
     * This endpoint is accessible to all users and returns a collection
     * of sample album data for demonstration purposes.
     *
     * @Route("/api/public", name="public")
     *
     * @return JsonResponse JSON response containing sample album data
     */
    public function publicAction(): JsonResponse
    {

        $data = [
            [
                'albumId' => "1",
                "id" => 1,
                "title" => "accusamus beatae ad facilis cum similique qui sunt",
                "description" => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout"
            ],
            [
                'albumId' => "2",
                "id" => 2,
                "title" => "accusamus beatae ad facilis cum similique qui sunt",
                "description" => "Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text"
            ],
            [
                'albumId' => "3",
                "id" => 3,
                "title" => "accusamus beatae ad facilis cum similique qui sunt",
                "description" => "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form"
            ],
        ];

        return new JsonResponse($data);
    }

    /**
     * Private API endpoint that returns sample data and requires authentication.
     *
     * This endpoint requires valid authentication credentials and returns
     * a collection of sample album data. Access is controlled through
     * Auth0 JWT authentication.
     *
     * @Route("/api/private", name="private")
     *
     * @return JsonResponse JSON response containing sample album data
     */
    public function privateAction(): JsonResponse
    {
        $data = [
            [
                'albumId' => "1",
                "id" => 1,
                "title" => "accusamus beatae ad facilis cum similique qui sunt",
                "description" => "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout"
            ],
            [
                'albumId' => "2",
                "id" => 2,
                "title" => "accusamus beatae ad facilis cum similique qui sunt",
                "description" => "Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text"
            ],
            [
                'albumId' => "3",
                "id" => 3,
                "title" => "accusamus beatae ad facilis cum similique qui sunt",
                "description" => "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form"
            ],
        ];

        return new JsonResponse($data);
    }
}
