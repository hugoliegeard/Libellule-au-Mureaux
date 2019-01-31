<?php

namespace Libellule\Router;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Router
{

    private $router;

    /**
     * Router constructor.
     * Initialiser le router avec
     * le tableau de routes
     * @param array $l_routes
     */
    public function __construct(array $l_routes)
    {
        # Initialisation de AltoRouter
        $this->router = new \AltoRouter();

        # Passage du tableau de routes au router
        $this->router->addRoutes($l_routes);
    }

    /**
     * AltoRouter détecte la route et retourne
     * le controller et l'action à executer !
     * @param Request $request
     * @return Response
     */
    public function matcher(Request $request): Response
    {

        # Mise en Place du BasePath
        $this->router->setBasePath($request->getBaseUrl());

        # Cherche une correspondance entre l'URL
        # et notre tableau de route.
        $match = $this->router->match();

        # Si une correspondance est trouvé,
        # On execute le controleur et l'action.
        if($match) {

            # Vérification du match
            #dump($match);

            $target = explode('::', $match['target']);
            $controller = new $target[0];
            $action = $target[1];

            # Execution du Controller
            # return $controller->$action();
            return call_user_func_array([$controller, $action], $match['params']);

        } else {
            return new Response('Erreur 404', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Permet la génération des Urls
     * @param string $routeName
     * @param array $params
     * @return string
     */
    public function generateUrl(string $routeName, array $params)
    {
        return $this->router->generate($routeName, $params);
    }

}
