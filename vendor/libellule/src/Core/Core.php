<?php

namespace Libellule\Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Core
{
    public function handle(Request $request): Response
    {
        # Aperçu de Request
        # dump($request);

        # Récupération des paramètres avecf Request
        $controller = $request->get('controller');
        $action = $request->get('action');

        if($controller == "front" && $action == "index") {
            # echo "<h1>JE SUIS SUR LA PAGE D'ACCUEIL</h1>";
            return new Response("<h1>JE SUIS SUR LA PAGE D'ACCUEIL</h1>");
        }

        if($controller == "front" && $action == "categorie") {
            # echo "<h1>JE SUIS SUR LA PAGE CATEGORIE</h1>";
            return new Response("<h1>JE SUIS SUR LA PAGE CATEGORIE</h1>");
        }

        if($controller == "front" && $action == "article") {
            # echo "<h1>JE SUIS SUR LA PAGE ARTICLE</h1>";
            return new Response("<h1>JE SUIS SUR LA PAGE ARTICLE</h1>");
        }
    }
}
