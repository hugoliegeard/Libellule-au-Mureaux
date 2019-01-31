<?php

namespace Libellule\Model;


interface RepositoryInterface
{
    /**
     * Récupère un Enregistrement
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public function fetch(string $sql, array $params = array()): object;

    /**
     * Récupère plusieurs enregistrement
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public function fetchAll(string $sql, array $params = array()): object;
}