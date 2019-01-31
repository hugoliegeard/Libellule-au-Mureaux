<?php

namespace Libellule\Controller;


use Doctrine\DBAL\Connection;
use Libellule\Model\ObjectManager;
use Libellule\Model\ObjectRepository;
use Libellule\Model\RepositoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
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

    /**
     * Génératoin d'une URL depuis le Controller
     * @param string $route
     * @param array $parameters
     * @return string
     */
    protected function generateUrl(string $route, array $parameters = array()): string
    {
        return $this->container->get('router')->generateUrl($route, $parameters);
    }

    /**
     * Redirige l'utilisateur sur l'URL
     * @param string $url
     * @return RedirectResponse
     */
    protected function redirect(string $url): RedirectResponse
    {
        return new RedirectResponse($url);
    }

    /**
     * Redirige l'utilisateur sur la route.
     * @param string $route
     * @param array $parameters
     * @return RedirectResponse
     */
    protected function redirectToRoute(string $route, array $parameters = array()): RedirectResponse
    {
        return $this->redirect($this->generateUrl($route, $parameters));
    }

    protected function getDoctrine(): Connection {
        return $this->container->get('doctrine');
    }

    protected function getManager(): ObjectManager {
        return $this->container->get('object_manager');
    }

}
