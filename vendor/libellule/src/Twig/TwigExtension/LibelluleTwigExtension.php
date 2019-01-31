<?php

namespace Libellule\Twig\TwigExtension;


use Libellule\Core\Container\Container;
use Libellule\Router\Router;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\VarDumper\VarDumper;
use Twig_Function;

class LibelluleTwigExtension extends \Twig_Extension
{

    private $publicDir, $router;

    public function __construct(string $publicDir)
    {
        $container = Container::getInstance();
        $this->router = $container->get('router');
        $this->publicDir = $publicDir;
    }

    /**
     * Retourne un tableau de fonction twig.
     * Nous pouvons ainsi créer nos propres
     * fonctions dans twig.
     * @return array|Twig_Function[]
     */
    public function getFunctions()
    {
        return [
            new Twig_Function('asset', [$this, 'asset']),
            new Twig_Function('path', [$this, 'path']),
            new Twig_Function('render', [$this, 'render'], ['is_safe' => ['html']]),
            new Twig_Function('controller', [$this, 'controller']),
            new Twig_Function('dump', [$this, 'dump']),
        ];
    }

    /**
     * Permet de générer une route
     * @param string $routeName
     * @param array $params
     * @return string
     */
    public function path(string $routeName, array $params = array()): string
    {
        /** @var Router $router */
        $router = $this->router;
        return $router->generateUrl($routeName, $params);
    }

    /**
     * Permet de générer le chemin complet
     * vers les assets.
     * @param string $asset
     * @return string
     */
    public function asset(string $asset)
    {
        return $this->publicDir . '/' . $asset;
    }

    public function dump($debug)
    {
        return VarDumper::dump($debug);
    }

    public function controller(string $controllerName, array $params = array()): Response
    {
        $target = explode('::', $controllerName);
        $controller = new $target[0];
        $action = $target[1];
        return call_user_func_array([$controller, $action], $params);
    }

    public function render(Response $response)
    {
        return $response->getContent();
    }

}
