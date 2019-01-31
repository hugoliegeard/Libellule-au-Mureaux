<?php
/**
 * Created by PhpStorm.
 * User: formateur
 * Date: 31/01/2019
 * Time: 17:22
 */

namespace App\Model;


class Article
{
    private $id, $titre;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Article
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

}