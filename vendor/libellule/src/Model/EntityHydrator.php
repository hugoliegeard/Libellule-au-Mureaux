<?php

namespace Libellule\Model;


use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Hydrator\ReflectionHydrator;

abstract class EntityHydrator
{
    public function hydrateResultSet(string $persistentObject, array $dataSource)
    {
        $resultSet = new HydratingResultSet(new ReflectionHydrator(), new $persistentObject);
        return $resultSet->initialize($dataSource);
    }

    public function hydrate(string $persistentObject, array $dataSource)
    {
        $hydrator = new ReflectionHydrator();
        return $hydrator->hydrate($dataSource, new $persistentObject);
    }
}