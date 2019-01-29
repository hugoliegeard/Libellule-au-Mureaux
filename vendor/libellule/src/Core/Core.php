<?php

namespace Libellule\Core;

use App\Controller\FrontController;
use Libellule\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Core
{
    private $router, $request;

    /**
     * Core constructor.
     * Au moment ou mon application s'initialise, mon
     * router lui aussi au meme moment s'initialise avec
     * les routes provenants de config.php.
     * @param array $l_routes Tableau des Routes de mon App.
     */
    public function __construct(array $l_routes)
    {
        $this->router =  new Router($l_routes);
    }

    public function handle(Request $request): Response
    {
        # Aperçu de Request
        # dump($request);

        $this->request = $request;

        /**
         *  On appel la fonction matcher pour rechercher
         * une correspondance entre l'URL de la requète
         * et le tableau de routes. Puis on retourne la
         * réponse correspondante.
         */
        return $this->router->matcher($request);

    }
}
