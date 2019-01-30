<?php

namespace Libellule\Core\Container;


use Tightenco\Collect\Support\Collection;

final class Container
{
    private static $instance;
    private $instances;

    # On bloque l'instantiation de la classe
    private function __construct()
    {
        $this->instances = new Collection();
    }

    /** Permet de récupérer une instance */
    public function get(string $key)
    {
        #return $this->instances[$key];
        return $this->instances->get($key);
    }

    /** Permet de stocker une instance */
    public function set(string $key, $value)
    {
        # $this->instances[$key] = $value;
        $this->instances->put($key, $value);
    }

    /** Permet de vérifier la présence d'une instance */
    public function has(string $key)
    {
        # return in_array($key, $this->instances);
        return $this->instances->has($key);
    }

    /**
     * Permet de retourner une instance
     * unique du container.
     */
    public static function getInstance()
    {
        # Je crée une instance de Container
        # Uniquement si self::$instance n'existe pas.
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        /**
         * La première fois je retourne une nouvelle instance.
         * Les fois suivantes je retourne la même instance.
         */
        return self::$instance;

    }

}
