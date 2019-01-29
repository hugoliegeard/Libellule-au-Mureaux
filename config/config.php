<?php

    # Déclaration des routes de notre App
    $l_routes = [
        # 1. La Méthode HTTP, GET, POST, PUT, DELETE, ...
        # 2. Le Format de l'URL dans le navigateur.
        # 3. Le Controller::Action à utiliser.
        # 4. L'Identifiant de la route.
        # cf. http://altorouter.com/usage/mapping-routes.html

        # Routes pour la gestion du site
        ['GET', '/', 'App\Controller\FrontController::homeAction', 'front_home'],
        ['GET', '/[:categorie]', 'App\Controller\FrontController::categorieAction', 'front_categorie'],
        ['GET', '/[:categorie]/[i:id]-[:slug].html', 'App\Controller\FrontController::articleAction', 'front_article'],

        # Routes pour la gestion des articles
        ['GET', '/creer-un-article.html', 'App\Controller\ArticleController::createAction', 'article_create'],
        ['GET', '/editer-un-article/[i:id].html', 'App\Controller\ArticleController::editAction', 'article_edit'],
    ];

