<?php

namespace App\Model;


class Categorie
{
    private $id, $libelle;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Categorie
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     * @return Categorie
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
        return $this;
    }

}
