<?php

namespace App\Controller;


use App\Model\Article;
use App\Model\Categorie;
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

        /** @var Categorie $categorie */
        $categorie = $this->getManager()
            ->getRepository(Categorie::class)
            ->fetch('SELECT * FROM categorie WHERE libelle = :libelle', [
                'libelle' => $categorie
            ]);

        $articles = $this->getManager()
            ->getRepository(Article::class)
            ->fetchAll("SELECT * FROM article WHERE categorie_id = :categorie_id", [
                'categorie_id' => $categorie->getId()
            ]);

        return $this->render('front/categorie.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * Page Article
     * @return Response
     */
    public function articleAction()
    {
        return $this->render('front/article.html.twig');
    }

    /**
     * Génère l'affichage du menu
     */
    public function nav()
    {
        # Récupération des Catégories
        $conn = $this->getDoctrine();
        $statement = $conn->prepare('SELECT * FROM categorie');
        $statement->execute();
        $categories = $statement->fetchAll();

        # Rendu de la navigation
        return $this->render('components/_nav.html.twig', [
            'categories' => $categories
        ]);
    }
}
