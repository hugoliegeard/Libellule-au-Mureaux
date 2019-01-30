<?php

namespace App\Controller;


use Libellule\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class FrontController extends AbstractController
{

    /**
     * Page d'Accueil
     * @return Response
     */
    public function homeAction()
    {
        return $this->render('front/home.html.twig');
    }

    /**
     * Page Catégorie
     * @param $categorie
     * @return Response
     */
    public function categorieAction($categorie)
    {
        return $this->render('front/categorie.html.twig');
    }

    /**
     * Page Article
     * @return Response
     */
    public function articleAction()
    {
        return $this->render('front/article.html.twig');
    }
}
