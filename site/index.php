<?php
/**
 * Routeur de l'application.
 *
 * La version 1 utilisait des GET pour le routage
 * alors que la version 2 décortique l'URL grâce au
 * RewriteEngine d’apache.
 *
 * @package GroupMaker
 * @author Maxime Bernard
 * @version 2
 */

namespace App;

use App\Controller\GroupController;

require_once 'Classes/AutoLoader.php';
Autoloader::register();
session_start();

/**
 * Class index
 */
class index {

    /**
     * @var GroupController
     */
    private GroupController $controller;

    /**
     * @var array|false|string[]
     */
    private array $route;

    /**
     * Constructeur de l'index.
     */
    public function __construct()
    {
        $this->controller = new GroupController();
        $this->route = explode('/', $_GET['url']);
    }

    /**
     * Le site se compose de 7 pages:
     *
     *  - index(/): La page par défaut, elle affiche la page d'accueil.
     *  - calculate(/calculate): Traite les données après l'envoi des informations de
     *    l'utilisateur sur la page d'accueil et redirige vers la page result.
     *  - result(/result): Page d'affichage du résultat de calculate sous forme de tableau.
     *    Les fonctions de téléchargement et de partage sont disponibles sur cette page.
     *  - getDoc(/getDoc): Script de téléchargement du nouveau fichier XLSX.
     *  - fileUpload(/fileUpload): Script d'upload du fichier de l'utilisateur sur le serveur.
     *  - share(/share): Cette page génère, si besoin, le lien de partage et l'affiche.
     *  - error(/???): Si la page demandée n'existe pas/plus, affiche la page 404.
     */
    public function routing(): void
    {
        if ($this->route[0]) {
            switch ($this->route[0]) {
                case 'calculate':
                    $this->controller->calculate();
                    break;
                case 'result':
                    $this->controller->resultShow();
                    break;
                case 'getDoc':
                    $this->controller->getDoc();
                    break;
                case 'fileUpload':
                    $this->controller->fileUpload();
                    break;
                case 'share':
                    $this->controller->generateShare();
                    break;
                default:
                    $this->controller->error();
                    break;
            }
        } else {
            $this->controller->indexShow();
        }
    }
}

$index = new index();
$index->routing();
