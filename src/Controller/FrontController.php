<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class FrontController
{

    /**
     * Page d'Accueil
     * @return Response
     */
    public function homeAction()
    {
        return new Response("<h1>JE SUIS SUR LA PAGE D'ACCUEIL</h1>");
    }

    /**
     * Page Catégorie
     * @param $categorie
     * @return Response
     */
    public function categorieAction($categorie)
    {
        return new Response("<h1>JE SUIS SUR LA PAGE CATEGORIE : $categorie</h1>");
    }

    /**
     * Page Article
     * @return Response
     */
    public function articleAction()
    {
        return new Response("<h1>JE SUIS SUR LA PAGE ARTICLE</h1>");
    }
}