<?php

namespace Libellule\Model;


class ObjectManager
{
    public function getRepository(string $persistentObject): RepositoryInterface
    {
        return new ObjectRepository($persistentObject);
    }
}