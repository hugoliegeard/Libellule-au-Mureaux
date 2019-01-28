<?php

use Libellule\Core\Core;
use Symfony\Component\HttpFoundation\Request;

# 1. Chargement de l'autoload de composer.
require __DIR__.'/../vendor/autoload.php';

# 2. Récupération de la Global Request
$request = Request::createFromGlobals();

# 3. Initialisation de l'Application
$core = new Core();

# 4. Traitement de la requète de l'utilisateur
$response = $core->handle($request);

# 5. Retour de la réponse au navigateur du client.
$response->send();
