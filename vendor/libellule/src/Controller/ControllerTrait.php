<?php

namespace Libellule\Controller;


use Symfony\Component\HttpFoundation\Response;

trait ControllerTrait
{
    protected function render(string $view, array $parameters = []): Response
    {
        # 1. Récupération de twig dans le container.
        $content = $this->container->get('twig')->render($view, $parameters);

        # 2. Fabrication d'une Réponse
        $response = new Response();

        # 3. Affectation du contenu de twig
        $response->setContent($content);

        # 4. Retour de la réponse à Core
        return $response;
    }
}
