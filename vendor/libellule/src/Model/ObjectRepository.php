<?php
/**
 * Created by PhpStorm.
 * User: formateur
 * Date: 31/01/2019
 * Time: 16:56
 */

namespace Libellule\Model;


use Doctrine\DBAL\Connection;
use Libellule\Core\Container\Container;

class ObjectRepository extends EntityHydrator implements RepositoryInterface
{

    private $conn, $persistentObject;

    /**
     * ObjectRepository constructor.
     * @param string $persistentObject
     */
    public function __construct(string $persistentObject)
    {
        $this->persistentObject = $persistentObject;
        $this->conn = Container::getInstance()->get('doctrine');
    }


    /**
     * Récupère un Enregistrement
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public function fetch(string $sql, array $params = array()): object
    {
        /** @var Connection $conn */
        $conn = $this->conn;
        $stmt = $conn->prepare($sql);

        foreach ($params as $key => $param) {
            $stmt->bindValue($key, $param);
        }

        $stmt->execute();
        $dataSource = $stmt->fetch();

        return $this->hydrate($this->persistentObject, $dataSource);

    }

    /**
     * Récupère plusieurs enregistrement
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public function fetchAll(string $sql, array $params = array()): object
    {
        /** @var Connection $conn */
        $conn = $this->conn;
        $stmt = $conn->prepare($sql);

        foreach ($params as $key => $param) {
            $stmt->bindValue($key, $param);
        }

        $stmt->execute();
        $dataSource = $stmt->fetchAll();

        return $this->hydrateResultSet($this->persistentObject, $dataSource);
    }
}