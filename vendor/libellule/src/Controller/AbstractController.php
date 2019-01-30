<?php

namespace Libellule\Controller;


use Libellule\Core\Container\Container;

abstract class AbstractController
{

    use ControllerTrait;

    private $container;

    public function __construct()
    {
        $this->container = Container::getInstance();
    }

    /**
     * @return mixed
     */
    protected function getParameter(string $name)
    {
        return $this->container->get($name);
    }

}
