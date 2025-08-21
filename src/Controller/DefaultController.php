<?php

/**
 * This file contains the DefaultController class for handling the default home route.
 *
 * @package App\Controller
 * @author  Symfony Auth0 API
 * @since   1.0.0
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Default controller for handling the main application routes.
 *
 * This controller serves as the entry point for the React frontend application,
 * handling all routes that should be passed to the React router.
 *
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * Main route handler for the React application.
     *
     * This method handles all routes that should be passed to the React frontend.
     * It uses a catch-all parameter to allow React Router to handle client-side routing.
     *
     * @Route("/{reactRouting}", name="home", defaults={"reactRouting": null})
     *
     * @param string|null $reactRouting The route parameter that will be handled by React Router
     *
     * @return Response The rendered template response
     */
    public function index($reactRouting = null): Response
    {
        return $this->render('default/index.html.twig');
    }
}
