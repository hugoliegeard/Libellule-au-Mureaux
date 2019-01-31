<?php

namespace Libellule\Core;

use Libellule\Core\Container\Container;
use Libellule\Model\ObjectManager;
use Libellule\Router\Router;
use Libellule\Twig\TwigExtension\LibelluleTwigExtension;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Core
{
    private $l_routes, $l_database, $container;

    /**
     * Core constructor.
     * Au moment ou mon application s'initialise, mon
     * router lui aussi au meme moment s'initialise avec
     * les routes provenants de config.php.
     * @param array $l_routes Tableau des Routes de mon App.
     * @param string $l_database
     */
    public function __construct(array $l_routes, string $l_database)
    {
        # Chargement de la configuration des routes et de la BDD
        $this->l_routes = $l_routes;
        $this->l_database = $l_database;

        # Chargement du Container
        $this->container = Container::getInstance();
    }

    /**
     * Initialisation de la configuration
     * du Router.
     * @param array $l_routes
     */
    public function initializeRouter(array $l_routes)
    {
        $router = new Router($l_routes);
        $this->container->set('router', $router);
    }

    /**
     * Initialisation de la configuration de Twig
     * TODO : Ajouter la détection de l'environnement pour le cache
     */
    public function initializeTwig(string $baseUrl)
    {
        $loader = new Twig_Loader_Filesystem($this->getTemplateDir());
        $twig = new Twig_Environment($loader, [
            'cache' => false,
        ]);
        $twig->addExtension(new LibelluleTwigExtension($baseUrl));
        $this->container->set('twig', $twig);
    }

    /**
     * Initialisation de Doctrine
     */
    private function initializeDoctrine()
    {
        $config = new \Doctrine\DBAL\Configuration();
        $connectionParams = array(
            'url' => $this->l_database,
        );
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
        $this->container->set('doctrine', $conn);
        $this->container->set('object_manager', new ObjectManager());
    }

    /**
     * Initialisation de Libellule
     */
    public function boot()
    {
        #Initialisation du Router
        $this->initializeRouter($this->l_routes);

        # Initialisation de Twig
        $this->initializeTwig($this->container->get('request')->getBaseUrl());

        # Initialisation de Doctrine
        $this->initializeDoctrine();
    }

    public function handle(Request $request): Response
    {
        # Aperçu de Request
        # dump($request);

        $this->container->set('request', $request);

        # Démarrage / Initialisation de Libellule
        $this->boot();
        # dump($this->container);

        /**
         *  On appel la fonction matcher pour rechercher
         * une correspondance entre l'URL de la requète
         * et le tableau de routes. Puis on retourne la
         * réponse correspondante.
         */
        $response = $this->container->get('router')->matcher($request);
        return $response;

    }

    /**
     * Retourne le dossier root
     * du projet.
     */
    public function getProjectDir()
    {
        # Permet de récuprer des informations sur l'objet
        $r = new \ReflectionObject($this);

        # Je récupère le nom du répertoire de mon fichier.
        $dir = dirname($r->getFileName(), 4);

        # Je recherche le dossier de mon projet.
        # Le dossier qui inclut le fichier composer.
        while (!file_exists($dir . '/composer.json')) {
            $dir = dirname($dir);
        }

        # On retourne le répertoire trouvé.
        return $dir;
    }

    /** Retourne le dossier template */
    public function getTemplateDir(): string
    {
        return $this->getProjectDir() . '/templates';
    }

    /** Retourne le dossier du cache */
    public function getCacheDir(): string
    {
        return $this->getProjectDir() . '/var/cache';
    }

    /** Retourne le dossier public */
    public function getPublicDir(): string
    {
        return $this->getProjectDir() . '/public';
    }

}
