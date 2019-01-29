<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class ArticleController
{

    public function createAction()
    {
        return new Response("<h1>CREER UN ARTICLE</h1>");
    }

    public function editAction()
    {
        return new Response("<h1>EDITER UN ARTICLE</h1>");
    }

}
